<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laptop;
use DB;
use App\Models\User;
use App\Models\reviews;

class laptopController extends Controller
{
    public function add(){
        $r=request();
        //$r=require//get all form input value
        if($r->file('imageName')!=''){
            $image=$r->file('imageName');  
            $image->move('images',$image->getClientOriginalName());                
            $imageName=$image->getClientOriginalName(); 
        }
        else{
            $imageName="empty.jpg";

        }
        $shopee = $r->shopee ?? '';
        $lazada = $r->lazada ?? '';
        $addproduct=laptop::create([
            'name'=>$r->laptopName,
            'manufacturer'=>$r->manufacturer,
            'price'=>$r->price,
            'process_model'=>$r->process_model,
            'graphics'=>$r->graphics,
            'display_technology'=>$r->display_technology,
            'screen_size'=>$r->screen_size,
            'screen_resolution'=>$r->screen_resolution,
            'storage'=>$r->storage,
            'memory'=>$r->memory,
            'operating_system'=>$r->operating_system,
            'connectivity' => $r->connectivity ?? 'default_value',
            'camera'=>$r->camera,
            'ports'=>$r->ports,
            'battery'=>$r->battery,
            'height' => $r->height,
            'width' => $r-> width, 
            'depth' => $r->depth,
            'weight'=>$r->weight,
            'type'=>$r->type,
            'filter' =>$r-> filter,
            'image'=>$imageName,
            'lazada' => $lazada,
            'shopee' => $shopee,
            
        ]);
        
        return redirect('addDone');
    }

    public function adddones()
    {
        $laptopCount = Laptop::count();
        return view('addDone',['laptopCount' => $laptopCount]);
    }

    public function showCategory($manufacturer){
        $showLaptop=laptop::all()->where('manufacturer',$manufacturer);
        return view('laptopCategory',  ['laptops' => $showLaptop, 'manufacturer' => $manufacturer]);
    }

    public function showCategorys($manufacturer){
        $showLaptop=laptop::all()->where('manufacturer',$manufacturer);
        return view('adminLaptopCategory',  ['laptops' => $showLaptop, 'manufacturer' => $manufacturer]);
    }

    public function view(){
        //$viewAll=Product::all();//run SQL select * from products
        $viewAll= laptop::take(10)->get();
        return view('adminPage')->with('laptops',$viewAll);
    }

    public function views(){
        $viewAll=laptop::paginate();
        return view('selectLaptop', ['laptops' => $viewAll]);
    }

    public function delete($id){
        $deleteLaptop=laptop::find($id); //delete from products where id=$id
        if ($deleteLaptop) {
            // Delete related reviews
            $deleteLaptop->reviews()->delete();
    
            // Now delete the laptop
            $deleteLaptop->delete();
        }
        return redirect()->route('deleteDone');
    }
    public function deletedone()
    {
        $laptopCount = Laptop::count();
        return view('deleteDone',['laptopCount' => $laptopCount]);
    }

    public function edit($id){
        $editLaptop = Laptop::findOrFail($id); 
        return view('editLaptop', ['laptop' => $editLaptop]);
    }
    

    public function update() {
        $request = request();
        
        $laptop = Laptop::find($request->lid);
        if (!$laptop) {
            return redirect()->route('adminPage')->with('error', '找不到产品');
        }
    
        $this->validate($request, [
            'laptopName' => 'required',
            'price' => 'required|numeric',
            // Add validation rules for other fields
        ]);
    
        if ($request->hasFile('imageName')) {
            $image = $request->file('imageName');
            if ($image->isValid()) {
                $imageName = $image->getClientOriginalName();
                $image->store('images');
                $laptop->image = $imageName;
            }
        }
    
        $laptop->name = $request->laptopName;
        $laptop->manufacturer = $request->manufacturer;
        $laptop->price = $request->price;
        $laptop->process_model = $request->process_model;
        $laptop->graphics = $request->graphics;
        $laptop->display_technology = $request->display_technology;
        $laptop->screen_size = $request->screen_size;
        $laptop->screen_resolution = $request->screen_resolution;
        $laptop->storage = $request->storage;
        $laptop->memory = $request->memory;
        $laptop->operating_system = $request->operating_system;
        $laptop->connectivity = $request->connectivity ?? 'default_value';
        $laptop->camera = $request->camera;
        $laptop->ports = $request->ports;
        $laptop->battery = $request->battery;
        $laptop->height = $request->height;
        $laptop->width = $request->width;
        $laptop->depth = $request->depth;
        $laptop->weight = $request->weight;
        $laptop->type = $request->type;
        $laptop->filter = $request->filter;

        if ($request->lazada !== null) {
            $laptop->lazada = $request->lazada;
        }
    
        if ($request->shopee !== null) {
            $laptop->shopee = $request->shopee;
        }
    
        $laptop->save();
    
        return redirect()->route('editDone');
    }
    

    public function editdones()
    {
        return view('editDone');
    }

    public function details($id){
        $laptopDetails = Laptop::find($id);

        return view('laptopDetails', ['laptops' => $laptopDetails]);
    }
    

    public function laptopDetail($id){
        $laptopDetails = Laptop::find($id);
        
        return view('adminLaptopDetails', ['laptops' => $laptopDetails]);
    }

    public function laptopList(){
        $showLaptop=Laptop::all();
        return view('showAllLaptop')->with('laptops',$showLaptop);
    }

    public function adminLaptopList(){
        $showLaptop=Laptop::all();
        return view('adminShowAllLaptop')->with('laptops',$showLaptop);
    }

    public function search()
    {
        $r = request();
        $keyword = $r->keyword;

        // Convert the keyword to a regex pattern
        $keywords = explode(' ', $keyword);
        $regexPattern = implode('.*', $keywords);
        $regexPattern = '.*' . $regexPattern . '.*';

        // 使用正则表达式进行模糊搜索
        $laptops = DB::table('laptops')
            ->where('name', 'REGEXP', $regexPattern)
            ->orWhere('manufacturer', 'REGEXP', $regexPattern)
            ->paginate(10);

        return view('showAllLaptop')->with(['laptops' => $laptops, 'keyword' => $keyword]);
    }

    
    public function adminSearch(){
        $r=request();
        $keyword=$r->keyword;

        $keywords = explode(' ', $keyword);
        $regexPattern = implode('.*', $keywords);
        $regexPattern = '.*' . $regexPattern . '.*';

        $laptops = DB::table('laptops')
            ->where('name', 'REGEXP', $regexPattern)
            ->orWhere('manufacturer', 'REGEXP', $regexPattern)
            ->paginate(10);
            
        return view('adminShowAllLaptop')->with(['laptops' => $laptops, 'keyword' => $keyword]);   //Select * from products where name like '%$keyword%'
    }

    public function editSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $manufacturer = $request->input('laptop_brand');

        $query = Laptop::query();

        if ($manufacturer !== 'all') {
            $query->where('manufacturer', $manufacturer);
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $laptops = $query->get();

        return view('selectLaptop', ['laptops' => $laptops]);
    }

    public function showLaptopByBrand(Request $request)
    {
        $selectedLaptopBrand = $request->input('laptop_brand', 'all'); // 默认为 All 类型

        $query = Laptop::query();

        if ($selectedLaptopBrand !== 'all') {
            $query->where('laptop_brand', $selectedLaptopBrand);
        }
        
        $laptops = $query->get();

        return view('selectLaptop', compact('laptops'));
    }

}


?>