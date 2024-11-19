<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_product_list()
    {
        
        Product::factory()->count(5)->create(['stock' => 10]);

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);
        $response->assertViewIs('product.index');
        $response->assertViewHas('viewData');
        $this->assertGreaterThanOrEqual(5, count($response->viewData('viewData')['products']));
    }


    public function it_redirects_to_home_when_product_not_found()
    {
        
        $response = $this->get(route('product.show', ['id' => 999]));

        $response->assertRedirect(route('home.index'));
    }
}
