<?php

use App\Livewire\Teste;
use App\Livewire\Dashboard;
use App\Models\SalesCommission;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ClientController;

Route::view('/', 'welcome');

route::resource('/teste', Teste::class);

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    route::resource('/clients', ClientController::class);
    route::resource('/sales', SaleController::class);


    route::get('/chart', function () {
        $fields = implode(',', SalesCommission::getCollumns());

        // dd($fields);

        $question = 'Gere um gráfico das vendas por empresas no eixo y ao longo dos últimos 5 anos';

        // Usando o endpoint de chat para interagir com o modelo
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo', // ou 'gpt-4' se você tiver acesso
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Considerando a lista de campos ($fields), gere uma configuração json do Vega-lite v5 (sem campos de dados e com descrição) que atenda o seguinte pedido: $question"
                ],
            ],
            'max_tokens' => 150, // Aumentei o limite de tokens para garantir uma resposta completa
        ]);

        $config = $response['choices'][0]['message']['content'];

        dd($config);
    });
});

require __DIR__.'/auth.php';
