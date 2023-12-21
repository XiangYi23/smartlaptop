<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use Illuminate\Support\Facades\Log;

class laptopFilterController extends Controller
{
    public function filter(Request $request)
    {
        Log::debug('Laptop Filter request received:', $request->all());
        $query = Laptop::query();

        if ($request->has('price_from') && $request->has('price_to')) {
            $priceFrom = $request->input('price_from');
            $priceTo = $request->input('price_to');
    
            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('price', [$priceFrom, $priceTo]);
        }

        if ($request->has('manufacturer')) {
            $query->whereIn('manufacturer', $request->input('manufacturer'));
        }

        if ($request->has('process_model')) {
            $values = $request->input('process_model');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhere('process_model', 'like', '%' . $value . '%');
                }
            });
        }
        
        if ($request->has('graphics_option')) {
            $values = $request->input('graphics_option');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhere('graphics', 'like', '%' . $value . '%');
                }
            });
        }

        if ($request->has('display-tech')) {
            $query->whereIn('display_technology', $request->input('display-tech'));
        }

        // Screen Size Filter
        if ($request->has('screen-size-from') && $request->has('screen-size-to')) {
            $screenSizeFrom = $request->input('screen-size-from');
            $screenSizeTo = $request->input('screen-size-to');
    
            $mappedScreenSizeFrom = $screenSizeFrom . '-inch';
            $mappedScreenSizeTo = $screenSizeTo . '-inch';
        
            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('screen_size', [$screenSizeFrom, $screenSizeTo]);
        }

        // Screen Resolution Filter
        if ($request->has('screen-resolution')) {
            $values = $request->input('screen-resolution');
            $formattedValues = array_map(function($value) {
                return str_replace(' ', '', $value);
            }, $values);
        
            $query->where(function($query) use ($formattedValues) {
                foreach ($formattedValues as $value) {
                    $query->orWhere('screen_resolution', 'like', '%' . $value . '%');
                }
            });
        }
        
        // Memory Filter
        if ($request->has('memory-from') && $request->has('memory-to')) {
            $memoryFrom = $request->input('memory-from');
            $memoryTo = $request->input('memory-to');

            $mappedMemoryFrom = $memoryFrom . '-GB Ram';
            $mappedMemoryTo = $memoryTo . '-GB Ram';

            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('memory', [$memoryFrom, $memoryTo]);
        }

        // Storage Filter
        if ($request->has('storage-from') && $request->has('storage-to')) {
            $storageFrom = $request->input('storage-from');
            $storageTo = $request->input('storage-to');
    
            $mappedStorageFrom = $storageFrom . '-GB';
            $mappedStorageTo = $storageTo . '-GB';
        
            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('storage', [$mappedStorageFrom, $mappedStorageTo]);
        }    

        // Operating System Filter
        if ($request->has('os')) {
            $values = $request->input('os');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhere('operating_system', 'like', '%' . $value . '%');
                }
            });
        }

        // Battery Filter
        if ($request->has('battery_from') && $request->has('battery_to')) {
            $batteryFrom = $request->input('battery_from');
            $batteryTo = $request->input('battery_to');
    
            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('battery', [$batteryFrom, $batteryTo]);
        }

        // Laptop Type Filter
        // Operating System Filter
        if ($request->has('laptop-type')) {
            $values = $request->input('laptop-type');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhere('type', 'like', '%' . $value . '%');
                }
            });
        }
        
        if ($request->has('laptop-filter')) {
            $values = $request->input('laptop-filter');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhere('filter', 'like', '%' . $value . '%');
                }
            });
        }

        $laptops = $query->get();
        Log::debug('Filtered laptops:', $laptops->toArray());

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return response()->json(['laptops' => $laptops]);
        }

        // For non-AJAX requests, return the view with laptops data
        return view('laptopFilter', ['laptops' => $laptops]);
    }
}
