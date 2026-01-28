<?php

namespace App\Console\Commands;

use App\Models\Business;
use App\Models\WithdrawalMethod;
use App\Services\Wallet\WalletService;
use Illuminate\Console\Command;

class WalletTestCommand extends Command
{
    protected $signature = 'wallet:test {--business= : ID do business para testar}';

    protected $description = 'Testa as operações da wallet: depósito, transferência e saque';

    public function handle(WalletService $walletService): int
    {
        $this->info('🏦 Iniciando teste da Wallet...');
        $this->newLine();

        // Busca ou cria business
        $businessId = $this->option('business');
        $business = $businessId
            ? Business::query()->find($businessId)
            : Business::query()->first();

        if (! $business) {
            $this->error('Nenhum business encontrado. Crie um business primeiro.');

            return self::FAILURE;
        }

        $this->info("📋 Business: {$business->legal_name} (ID: {$business->id})");
        $this->newLine();

        // Obtém ou cria wallet
        $wallet = $walletService->getWallet($business);
        $this->info("💼 Wallet ID: {$wallet->id}");
        $this->info("   Saldo inicial: R$ {$walletService->getAvailableBalance($wallet)}");
        $this->newLine();

        // 1. DEPÓSITO
        $this->comment('1️⃣ Testando DEPÓSITO...');
        $depositTransaction = $walletService->deposit(
            $wallet,
            '5000.00',
            null,
            null,
            'Depósito de teste via comando'
        );
        $this->info("   ✅ Depósito de R$ 5.000,00 realizado");
        $this->info("   Transaction ID: {$depositTransaction->id}");
        $this->info("   Saldo após: R$ {$walletService->getAvailableBalance($wallet)}");
        $this->newLine();

        // 2. SEGUNDO DEPÓSITO
        $this->comment('2️⃣ Testando SEGUNDO DEPÓSITO...');
        $deposit2 = $walletService->deposit(
            $wallet,
            '2500.50',
            null,
            null,
            'Venda de produto #123'
        );
        $this->info("   ✅ Depósito de R$ 2.500,50 realizado");
        $this->info("   Saldo após: R$ {$walletService->getAvailableBalance($wallet)}");
        $this->newLine();

        // 3. HOLD
        $this->comment('3️⃣ Testando HOLD (bloqueio)...');
        $hold = $walletService->createHold($wallet, '1000.00', 'Reserva para teste');
        $this->info("   ✅ Hold de R$ 1.000,00 criado");
        $this->info("   Saldo disponível: R$ {$walletService->getAvailableBalance($wallet)}");
        $this->info("   Saldo efetivo: R$ {$walletService->getEffectiveBalance($wallet)}");
        $this->newLine();

        // 4. LIBERA HOLD
        $this->comment('4️⃣ Liberando HOLD...');
        $walletService->releaseHold($hold);
        $this->info("   ✅ Hold liberado");
        $this->info("   Saldo efetivo: R$ {$walletService->getEffectiveBalance($wallet)}");
        $this->newLine();

        // 5. SAQUE
        $this->comment('5️⃣ Testando SAQUE...');
        $withdrawalMethod = WithdrawalMethod::pix();

        if (! $withdrawalMethod) {
            $this->warn('   ⚠️ Método de saque PIX não encontrado, pulando...');
        } else {
            $withdrawalRequest = $walletService->requestWithdrawal(
                $wallet,
                '1500.00',
                $withdrawalMethod->id,
                [
                    'bank_name' => 'Banco do Brasil',
                    'agency' => '1234',
                    'account' => '56789-0',
                    'pix_key' => 'teste@email.com',
                ]
            );
            $this->info("   ✅ Saque de R$ 1.500,00 solicitado (ID: {$withdrawalRequest->id})");
            $this->info("   Status: pendente");
            $this->info("   Saldo efetivo: R$ {$walletService->getEffectiveBalance($wallet)}");

            // Processa o saque
            $this->comment('   Processando saque...');
            $withdrawalTransaction = $walletService->processWithdrawal($withdrawalRequest);
            $this->info("   ✅ Saque processado!");
            $this->info("   Saldo após: R$ {$walletService->getAvailableBalance($wallet)}");
        }
        $this->newLine();

        // 6. ESTORNO
        $this->comment('6️⃣ Testando ESTORNO...');
        $refundTransaction = $walletService->refund($deposit2, 'Estorno de teste');
        $this->info("   ✅ Estorno de R$ 2.500,50 realizado");
        $this->info("   Saldo após: R$ {$walletService->getAvailableBalance($wallet)}");
        $this->newLine();

        // RESUMO FINAL
        $this->newLine();
        $this->info('📊 RESUMO FINAL:');
        $this->table(
            ['Métrica', 'Valor'],
            [
                ['Saldo Disponível', 'R$ ' . $walletService->getAvailableBalance($wallet)],
                ['Saldo Pendente', 'R$ ' . $walletService->getPendingBalance($wallet)],
                ['Saldo Efetivo', 'R$ ' . $walletService->getEffectiveBalance($wallet)],
                ['Total Transações', $wallet->transactions()->count()],
            ]
        );

        $this->newLine();
        $this->info('✅ Teste concluído com sucesso!');

        return self::SUCCESS;
    }
}
