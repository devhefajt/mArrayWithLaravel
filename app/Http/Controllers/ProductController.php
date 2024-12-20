<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Prod;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function skuGenerate(Request $request)
    {

        $baseSKU = $request->baseSKU;
        $variations = $request->variations;

        $categories = $variations[0]['options'];
        $subcategories = $variations[1]['options'];
        $sizes = $variations[2]['options'];
        $colors = $variations[3]['options'];
        $prices = $variations[4]['options'];
        $stocks = $variations[5]['options'];

        $output = [];

        foreach ($categories as $category) {
            foreach ($subcategories as $subcategory) {
                foreach ($sizes as $size) {
                    foreach ($colors as $color) {
                        foreach ($prices as $price) {
                            foreach ($stocks as $stock) {
                                //    $sku = "$baseSKU-$category-$subcategory-$size-$color-$price-$stock";

                                $output[] = Product::create([
                                    'sku' => $baseSKU,
                                    'category' => $category,
                                    'subcategory' => $subcategory,
                                    'size' => $size,
                                    'color' => $color,
                                    'price' => $price,
                                    'stock' => $stock,
                                ]);
                            }
                        }
                    }
                }
            }
        }

        return response()->json(['message' => 'SKUs generated successfully!', 'data' => $output]);
    }


    public function array1(Request $request)
    {
        $data = $request->all();

        // Ensure that the products data is properly structured (either a single product or multiple)
        $products = isset($data['products'][0]) ? $data['products'] : [$data['products']];


        foreach ($products as $productData) {

            $attributes = $productData['attributes'] ?? [];
            $categories = is_array($attributes['categories'] ?? null) ? $attributes['categories'] : [];
            $sizes = is_array($attributes['sizes'] ?? null) ? $attributes['sizes'] : [];
            $colors = is_array($attributes['colors'] ?? null) ? $attributes['colors'] : [];

            foreach ($categories as $category) {
                foreach ($sizes as $size) {
                    foreach ($colors as $color) {
                        Prod::create([
                            'name' => $productData['name'],
                            'details' => json_encode($productData['attributes']),
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'message' => 'Products created successfully!',
        ]);
    }


    public function array2(Request $request)
    {

        $data = $request->all();

        foreach ($data['departments'] as $departmentData) {
            $createdDepartments[] = Employee::create([
                'name' => $departmentData['name'],
                'teams' => json_encode($departmentData['teams']),
            ]);
        }

        return response()->json([
            'message' => 'Products created successfully!',
            'data' => $createdDepartments
        ]);
    }



    public function array3(Request $request)
    {

        $data = $request->all();

        // Input with Multiple Events: If the input has multiple events as an array (e.g., events contains an indexed array of objects), then $data['events'][0] will exist, and the original $data['events'] is directly assigned to $events.

        $events = isset($data['events'][0]) ? $data['events'] : [$data['events']];

        // Condition:

        // isset($data['events'][0])
        // Checks if the first element ([0]) of $data['events'] exists. This works because arrays in PHP are zero-indexed, and the presence of [0] indicates the key is an array of events.

        // True Case:

        // php
        // Copy code
        // $data['events']
        // If [0] exists, $data['events'] is already an array of events, so it is assigned directly.

        // False Case:

        // php
        // Copy code
        // [$data['events']]
        // If [0] does not exist, $data['events'] is a single event, so it is wrapped into an array.




        $createdEvents = [];

        foreach ($events as $eventData) {
            $createdEvents[] = Event::create([
                'name' => $eventData['name'],
                'sessions' => $eventData['sessions'], // Save sessions as JSON
            ]);
        }

        return response()->json([
            'message' => 'Events created successfully!',
            'data' => $createdEvents,
        ]);
    }

    public function array4(Request $request)
    {

        $data = $request->all();

        $orders = [];

        foreach ($data['items'] as $item) {

            $orders[] = Order::create([
                'name' => $item['name'],
                'options' => json_encode($item['options']),
            ]);
        }

        return response()->json([
            'message' => 'Orders created successfully!',
            'data' => $orders,
        ]);
    }


    public function array5(Request $request)
    {

        $data = $request->all();

        $vehicle = [];

        // $categories = $data['categories'] ?? [];

        foreach ($data['categories'] as $categoryName => $categoryDetails) {
            // Insert each category with its details as JSON
            $vehicle[] = Vehicle::create([
                'category' => $categoryName,
                'details' => $categoryDetails,
            ]);
        }

        return response()->json([
            'message' => 'Orders created successfully!',
            'data' => $vehicle,
        ]);
    }

    public function array6(Request $request)
    {
        $data = $request->all(); 
        $insertedItems = [];

        foreach ($data['categories'] as $category) {
            foreach ($category['items'] as $itemName => $types) {
                if (is_array($types)) {
                    // If types are present (like for Coffee and Tea)
                    foreach ($types as $type) {
                        $menuItem = Menu::create([
                            'category_name' => $category['name'],
                            'item_name' => $itemName,
                            'types' => [$type],
                        ]);
                        $insertedItems[] = $menuItem;
                    }
                } else {
                    // If there are no types, just insert the item with an empty array for types
                    $menuItem = Menu::create([
                        'category_name' => $category['name'],
                        'item_name' => $itemName,
                        'types' => [], 
                    ]);


                    $insertedItems[] = $menuItem;
                }
            }
        }

        return response()->json([
            'message' => 'Menu items inserted successfully',
            'data' => $insertedItems
        ]);
    }
}
