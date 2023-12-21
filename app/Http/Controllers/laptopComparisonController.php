<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laptop;
use App\Models\Compare;

class laptopComparisonController extends Controller
{
    //user
    public function compare(Request $request)
    {
        $id = $request->input('id');
        $compareLaptop = Laptop::findOrFail($id);

        // 获取同一制造商的3台随机笔记本电脑（排除所选的）
        $manufacturerId = $compareLaptop->manufacturer;
        $comparisonLaptops = Laptop::where('id', '!=', $id)
            ->where('manufacturer', '=', $manufacturerId)
            ->inRandomOrder()
            ->limit(2) // 由于已经有一个被选中的笔记本电脑，所以这里只需获取2个随机的额外笔记本电脑
            ->get();

        // 将比较的笔记本电脑分配给三个变量
        $secondCompareLaptop = $comparisonLaptops->shift();
        $thirdCompareLaptop = $comparisonLaptops->shift();

        return view('compareLaptop', [
            'laptop' => $compareLaptop,
            'secondCompareLaptop' => $secondCompareLaptop,
            'thirdCompareLaptop' => $thirdCompareLaptop,
        ]);
    }
    public function searchLaptops(Request $request)
    {
        try{
            $keyword = $request->input('keyword');
        
            $result = Laptop::query()
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'REGEXP', ".*$keyword.*")
                    ->orWhere('manufacturer', 'REGEXP', ".*$keyword.*");
            })
            ->with('details') // 使用 with 方法加载关联模型
            ->get();
        
            return response()->json($result);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error($e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function searchAndAdd(Request $request, $id)
    {
    $keyword = $request->input('keyword');

    // Convert the keyword to a regex pattern
    $keywords = explode(' ', $keyword);
    $regexPattern = implode('.*', $keywords);
    $regexPattern = '.*' . $regexPattern . '.*';

    // 搜索基于关键词的产品
    $searchResults = Laptop::where('name', 'REGEXP', $regexPattern)
        ->orWhere('manufacturer', 'REGEXP', $regexPattern)
        ->get();

    $compareLaptop = Laptop::findOrFail($id);

    // 如果搜索结果为空，显示 "Can't find the laptop" 消息
    if ($searchResults->isEmpty()) {
        $notFoundMessage = "Can't find the laptop.";
        return view('compareLaptop', [
            'laptop' => $compareLaptop,
            'searchResults' => new Collection(), // 返回空的集合
            'notFoundMessage' => $notFoundMessage
        ]);
    }

    // 如果已经有secondCompareLaptop，将所选择的laptop当成thirdCompareLaptop
    $secondCompareLaptop = $request->input('secondCompareLaptop');
    $thirdCompareLaptop = $request->input('thirdCompareLaptop');

    // Handle the selection of laptops based on search results
    $selectedLaptop = $request->input('selectedLaptop');
    if ($selectedLaptop && !$secondCompareLaptop) {
        $secondCompareLaptop = Laptop::findOrFail($selectedLaptop);
    } elseif ($selectedLaptop && !$thirdCompareLaptop) {
        $thirdCompareLaptop = Laptop::findOrFail($selectedLaptop);
    }

    return view('compareLaptop', [
        'laptop' => $compareLaptop,
        'comparisonLaptops' => $searchResults,
        'secondCompareLaptop' => $secondCompareLaptop,
        'thirdCompareLaptop' => $thirdCompareLaptop
    ]);
}



    public function addToComparisonList($id, $compareId)
    {
        // 查找要对比的笔记本电脑
        $laptop = Laptop::findOrFail($id);
        $comparedLaptop = Laptop::findOrFail($compareId);
    
        // 检查是否已存在相同的比较记录
        $existingComparison = Compare::where('laptop_id', $laptop->id)
            ->where('compared_laptop_id', $comparedLaptop->id)
            ->first();
    
        if (!$existingComparison) {
            // 如果不存在相同的比较记录，创建一个新的比较记录
            Compare::create([
                'laptop_id' => $laptop->id,
                'compared_laptop_id' => $comparedLaptop->id,
            ]);
        }
    
        // 设置第二个比较的笔记本电脑
        $secondComparedLaptop = $comparedLaptop;
    
        return view('compareLaptop', [
            'laptop' => $laptop,
            'secondComparedLaptop' => $secondComparedLaptop
        ]);
    }

    public function index(Request $request)
    {
        $laptop_id = $request->input('laptop_id');
        $laptop = laptop::findOrFail($laptop_id);

        $comparisonLaptops = [];
        return view('compareLaptop', ['laptop' => $laptop, 'comparisonLaptops' => $comparisonLaptops]);
    }

    public function removeComparison($id)
    {
        $laptop = laptop::findOrFail($id);
        Compare::where('laptop_id', $laptop->id)->delete();
        // 获取搜索结果或设置为空数组，具体取决于您的搜索逻辑
        $searchResults = [];
        $comparisonLaptops = Compare::where('laptop_id', $laptop->id)->get();
        
        return view('compareLaptop', [
            'laptop' => $laptop,
            'searchResults' => $searchResults,
            'comparisonLaptops' => $comparisonLaptops
        ]);
    }


}
