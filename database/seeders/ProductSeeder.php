<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Mini Coxinha',
                'description' => 'Deliciosas coxinhas de frango, perfeitas para começar a refeição.',
                'price' => 10.00,
                'category_id' => 1, // Appetizer
                'quantity' => 0
            ],
            [
                'name' => 'Feijoada Completa',
                'description' => 'Uma feijoada clássica com todos os acompanhamentos.',
                'price' => 35.00,
                'category_id' => 2, // Main Course
                'quantity' => 20
            ],
            [
                'name' => 'Pudim de Leite',
                'description' => 'Pudim cremoso feito com leite condensado, coberto com calda de caramelo.',
                'price' => 12.00,
                'category_id' => 3, // Dessert
                'quantity' => 30
            ],
            [
                'name' => ' Ref. Coca-Cola 250ml',
                'description' => 'Refrigerante clássico, perfeito para acompanhar qualquer refeição.',
                'price' => 5.00,
                'category_id' => 4, // Beverage
                'quantity' => 100
            ],
            [
                'name' => 'Suco de Laranja',
                'description' => 'Suco natural de laranja, sem açúcar e muito refrescante.',
                'price' => 8.00,
                'category_id' => 4, // Beverage
                'quantity' => 0
            ],
            [
                'name' => 'Pastel de Queijo',
                'description' => 'Pastel crocante recheado com queijo derretido.',
                'price' => 7.00,
                'category_id' => 1, // Appetizer
                'quantity' => 0
            ],
            [
                'name' => 'Bife à Parmegiana',
                'description' => 'Bife empanado coberto com molho de tomate e queijo.',
                'price' => 40.00,
                'category_id' => 2, // Main Course
                'quantity' => 15
            ],
            [
                'name' => 'Torta de Limão',
                'description' => 'Sobremesa refrescante com base crocante e recheio de limão.',
                'price' => 15.00,
                'category_id' => 3, // Dessert
                'quantity' => 25
            ],
            [
                'name' => 'Água Mineral 500ml',
                'description' => 'Água mineral natural para hidratação.',
                'price' => 3.00,
                'category_id' => 4, // Beverage
                'quantity' => 200
            ],
            [
                'name' => 'Salada de Frutas',
                'description' => 'Mix de frutas frescas, perfeito para sobremesa.',
                'price' => 9.00,
                'category_id' => 3, // Dessert
                'quantity' => 30
            ],
            [
                'name' => 'Bolinho de Bacalhau',
                'description' => 'Bolinho macio de bacalhau com tempero especial.',
                'price' => 15.00,
                'category_id' => 1, // Appetizer
                'quantity' => 25
            ],
            [
                'name' => 'Strogonoff de Frango',
                'description' => 'Clássico strogonoff com arroz e batata palha.',
                'price' => 32.00,
                'category_id' => 2, // Main Course
                'quantity' => 12
            ],
            [
                'name' => 'Brownie de Chocolate',
                'description' => 'Brownie macio com pedaços de chocolate.',
                'price' => 10.00,
                'category_id' => 3, // Dessert
                'quantity' => 0
            ],
            [
                'name' => 'Café Expresso',
                'description' => 'Café forte e aromático, ideal para qualquer momento.',
                'price' => 4.00,
                'category_id' => 4, // Beverage
                'quantity' => 100
            ],
            [
                'name' => 'Esfirra de Carne',
                'description' => 'Esfirra macia recheada com carne moída temperada.',
                'price' => 6.00,
                'category_id' => 1, // Appetizer
                'quantity' => 35
            ],
            [
                'name' => 'Pizza Margherita',
                'description' => 'Pizza clássica com molho, queijo e manjericão.',
                'price' => 50.00,
                'category_id' => 2, // Main Course
                'quantity' => 10
            ],
            [
                'name' => 'Mousse de Maracujá',
                'description' => 'Sobremesa leve e cremosa de maracujá.',
                'price' => 8.00,
                'category_id' => 3, // Dessert
                'quantity' => 30
            ],
            [
                'name' => 'Ref. Guaraná 350ml',
                'description' => 'Refrigerante com sabor brasileiro.',
                'price' => 5.00,
                'category_id' => 4, // Beverage
                'quantity' => 0
            ],
            [
                'name' => 'Quibe Frito',
                'description' => 'Quibe frito crocante e recheado.',
                'price' => 7.00,
                'category_id' => 1, // Appetizer
                'quantity' => 40
            ],
            [
                'name' => 'Lasanha Bolonhesa',
                'description' => 'Lasanha com molho bolonhesa e queijo gratinado.',
                'price' => 45.00,
                'category_id' => 2, // Main Course
                'quantity' => 15
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Sobremesa italiana com café e mascarpone.',
                'price' => 20.00,
                'category_id' => 3, // Dessert
                'quantity' => 15
            ],
            [
                'name' => 'Chá Gelado Limão 500ml',
                'description' => 'Chá gelado sabor limão, perfeito para refrescar.',
                'price' => 6.50,
                'category_id' => 4, // Beverage
                'quantity' => 60
            ],
            [
                'name' => 'Yakissoba de Legumes',
                'description' => 'Yakissoba vegetariano com legumes frescos.',
                'price' => 30.00,
                'category_id' => 2, // Main Course
                'quantity' => 20
            ],
            [
                'name' => 'Mousse de Chocolate',
                'description' => 'Sobremesa cremosa de chocolate.',
                'price' => 10.00,
                'category_id' => 3, // Dessert
                'quantity' => 30
            ],
            [
                'name' => 'Cerveja Artesanal 500ml',
                'description' => 'Cerveja artesanal gelada.',
                'price' => 12.00,
                'category_id' => 4, // Beverage
                'quantity' => 0
            ],
            [
                'name' => 'Risoto de Camarão',
                'description' => 'Risoto cremoso com camarão.',
                'price' => 40.00,
                'category_id' => 2, // Main Course
                'quantity' => 15
            ],
            [
                'name' => 'Pavê de Chocolate',
                'description' => 'Sobremesa de chocolate com biscoitos.',
                'price' => 15.00,
                'category_id' => 3, // Dessert
                'quantity' => 25
            ],
            [
                'name' => 'Café com Leite',
                'description' => 'Café com leite quente e cremoso.',
                'price' => 5.00,
                'category_id' => 4, // Beverage
                'quantity' => 100
            ],
            [
                'name' => 'Coxinha de Frango',
                'description' => 'Coxinha de frango crocante e saborosa.',
                'price' => 8.00,
                'category_id' => 1, // Appetizer
                'quantity' => 35
            ],
            [
                'name' => 'Macarrão à Carbonara',
                'description' => 'Macarrão com molho à base de ovos e bacon.',
                'price' => 35.00,
                'category_id' => 2, // Main Course
                'quantity' => 0
            ],
        ]);
    }
    
}
