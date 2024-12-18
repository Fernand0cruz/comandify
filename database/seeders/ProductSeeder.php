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
                'quantity' => 50,
                'is_available' => true,
            ],
            [
                'name' => 'Feijoada Completa',
                'description' => 'Uma feijoada clássica com todos os acompanhamentos.',
                'price' => 35.00,
                'category_id' => 2, // Main Course
                'quantity' => 20,
                'is_available' => true,
            ],
            [
                'name' => 'Pudim de Leite',
                'description' => 'Pudim cremoso feito com leite condensado, coberto com calda de caramelo.',
                'price' => 12.00,
                'category_id' => 3, // Dessert
                'quantity' => 30,
                'is_available' => true,
            ],
            [
                'name' => 'Coca-Cola 250ml',
                'description' => 'Refrigerante clássico, perfeito para acompanhar qualquer refeição.',
                'price' => 5.00,
                'category_id' => 4, // Beverage
                'quantity' => 100,
                'is_available' => true,
            ],
            [
                'name' => 'Suco de Laranja',
                'description' => 'Suco natural de laranja, sem açúcar e muito refrescante.',
                'price' => 8.00,
                'category_id' => 4, // Beverage
                'quantity' => 50,
                'is_available' => true,
            ],
            [
                'name' => 'Pastel de Queijo',
                'description' => 'Pastel crocante recheado com queijo derretido.',
                'price' => 7.00,
                'category_id' => 1, // Appetizer
                'quantity' => 40,
                'is_available' => true,
            ],
            [
                'name' => 'Bife à Parmegiana',
                'description' => 'Bife empanado coberto com molho de tomate e queijo.',
                'price' => 40.00,
                'category_id' => 2, // Main Course
                'quantity' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Torta de Limão',
                'description' => 'Sobremesa refrescante com base crocante e recheio de limão.',
                'price' => 15.00,
                'category_id' => 3, // Dessert
                'quantity' => 25,
                'is_available' => true,
            ],
            [
                'name' => 'Água Mineral 500ml',
                'description' => 'Água mineral natural para hidratação.',
                'price' => 3.00,
                'category_id' => 4, // Beverage
                'quantity' => 200,
                'is_available' => true,
            ],
            [
                'name' => 'Salada de Frutas',
                'description' => 'Mix de frutas frescas, perfeito para sobremesa.',
                'price' => 9.00,
                'category_id' => 3, // Dessert
                'quantity' => 30,
                'is_available' => true,
            ],
            [
                'name' => 'Bolinho de Bacalhau',
                'description' => 'Bolinho macio de bacalhau com tempero especial.',
                'price' => 15.00,
                'category_id' => 1, // Appetizer
                'quantity' => 25,
                'is_available' => true,
            ],
            [
                'name' => 'Strogonoff de Frango',
                'description' => 'Clássico strogonoff com arroz e batata palha.',
                'price' => 32.00,
                'category_id' => 2, // Main Course
                'quantity' => 12,
                'is_available' => true,
            ],
            [
                'name' => 'Brownie de Chocolate',
                'description' => 'Brownie macio com pedaços de chocolate.',
                'price' => 10.00,
                'category_id' => 3, // Dessert
                'quantity' => 40,
                'is_available' => true,
            ],
            [
                'name' => 'Café Expresso',
                'description' => 'Café forte e aromático, ideal para qualquer momento.',
                'price' => 4.00,
                'category_id' => 4, // Beverage
                'quantity' => 100,
                'is_available' => true,
            ],
            [
                'name' => 'Esfirra de Carne',
                'description' => 'Esfirra macia recheada com carne moída temperada.',
                'price' => 6.00,
                'category_id' => 1, // Appetizer
                'quantity' => 35,
                'is_available' => true,
            ],
            [
                'name' => 'Pizza Margherita',
                'description' => 'Pizza clássica com molho, queijo e manjericão.',
                'price' => 50.00,
                'category_id' => 2, // Main Course
                'quantity' => 10,
                'is_available' => true,
            ],
            [
                'name' => 'Mousse de Maracujá',
                'description' => 'Sobremesa leve e cremosa de maracujá.',
                'price' => 8.00,
                'category_id' => 3, // Dessert
                'quantity' => 30,
                'is_available' => true,
            ],
            [
                'name' => 'Refrigerante Guaraná 350ml',
                'description' => 'Refrigerante com sabor brasileiro.',
                'price' => 5.00,
                'category_id' => 4, // Beverage
                'quantity' => 80,
                'is_available' => true,
            ],
            [
                'name' => 'Quibe Frito',
                'description' => 'Quibe frito crocante e recheado.',
                'price' => 7.00,
                'category_id' => 1, // Appetizer
                'quantity' => 40,
                'is_available' => true,
            ],
            [
                'name' => 'Lasanha Bolonhesa',
                'description' => 'Lasanha com molho bolonhesa e queijo gratinado.',
                'price' => 45.00,
                'category_id' => 2, // Main Course
                'quantity' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Sobremesa italiana com café e mascarpone.',
                'price' => 20.00,
                'category_id' => 3, // Dessert
                'quantity' => 15,
                'is_available' => true,
            ],
            [
                'name' => 'Chá Gelado Limão 500ml',
                'description' => 'Chá gelado sabor limão, perfeito para refrescar.',
                'price' => 6.50,
                'category_id' => 4, // Beverage
                'quantity' => 60,
                'is_available' => true,
            ],
        ]);
    }
}
