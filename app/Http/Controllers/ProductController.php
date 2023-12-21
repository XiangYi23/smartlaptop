<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\product;
use App\Models\ProductsExtra;
class ProductController extends Controller
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
        $addproduct=Product::create([
            'name'=>$r->productName,
            'brand'=>$r->brand,
            'price'=>$r->price,
            'cpu'=>$r->cpu,
            'chipset'=>$r->chipset,
            'gpu'=>$r->gpu,
            'memory'=>$r->memory,
            'battery'=>$r->battery,
            'display_type'=>$r->display_type,
            'display_size'=>$r->display_size,
            'body_dimension'=>$r->body_dimension,
            'body_weight'=>$r->body_weight,
            'body_type'=>$r->body_type,
            'rear_camera'=>$r->rear_camera,
            'front_camera'=>$r->front_camera,
            'video'=>$r->video,
            'camera_features'=>$r->camera_features,
            'image'=>$imageName,
        ]);
        $shopee = $r->shopee ?? '';
        $lazada = $r->lazada ?? '';
        $addproduct=ProductsExtra::create([
            'name'=>$r->productName,
            'lazada' => $lazada,
            'shopee' => $shopee,
        ]);
        return redirect('addDone');
    }

    public function adddones()
    {
        return view('addDone');
    }

    public function showCategory($brand){
        $showProduct=Product::all()->where('brand',$brand);
        return view('productCategory')->with('products',$showProduct);
    }

    public function view(){
        //$viewAll=Product::all();//run SQL select * from products
        $viewAll=Product::paginate();
        return view('showProduct')->with('products',$viewAll);
    }

    public function views(){
        //$viewAll=Product::all();//run SQL select * from products
        $viewAll=Product::paginate();
        return view('selectProduct')->with('products',$viewAll);
    }

    public function productList(){
        $showProduct=Product::all();
        return view('showAllProduct')->with('products',$showProduct);
    }

    public function delete($id){
        $deleteProduct=Product::find($id); //delete from products where id=$id
        $deleteProduct->delete();
        return redirect()->route('deleteDone');
    }

    public function deletedone()
    {
        return view('deleteDone');
    }

    public function edit($id){
        $editProduct = Product::findOrFail($id); // 使用 findOrFail 获取指定 ID 的产品
        $productExtra = ProductsExtra::where('name', $editProduct->name)->first();
        return view('editProduct', ['product' => $editProduct, 'productExtra' => $productExtra]);
    }
    

    public function update(){
        $r=request();
        
        $product=Product::find($r->pid);
        if (!$product) {
        // 处理找不到产品的情况，可以跳转或抛出异常
        return redirect()->route('showProduct')->with('error', '找不到产品');
    }
        if($r->file('imageName')!=''){
            $image=$r->file('imageName');
            $image->move('images',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName(); 
            $product->image=$imageName;
        }
        $product->name=$r->productName;
        $product->price=$r->price;
        $product->brand=$r->brand;
        $product->cpu=$r->cpu;
        $product->chipset=$r->chipset;
        $product->gpu=$r->gpu;
        $product->memory=$r->memory;
        $product->battery=$r->battery;
        $product->display_type=$r->display_type;
        $product->display_size=$r->display_size;
        $product->body_dimension=$r->body_dimension;
        $product->body_weight=$r->body_weight;
        $product->body_type=$r->body_type;
        $product->rear_camera=$r->rear_camera;
        $product->front_camera=$r->front_camera;
        $product->video=$r->video;
        $product->camera_features=$r->camera_features;
        
        
        if ($r->hasFile('imageName')) {
            $product->image = $r->imageName->getClientOriginalName();
            $image = $r->file('imageName');
            $image->move('images', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName(); 
            $product->image = $imageName;
        }
        $product->save();

        $productExtra = ProductsExtra::where('name', $product->name)->first();
        if (!$productExtra) {
            $productExtra = new ProductsExtra();
            $productExtra->name = $product->name;
        }
        
        if ($r->lazada !== null) {
            $productExtra->lazada = $r->lazada;
        }
    
        if ($r->shopee !== null) {
            $productExtra->shopee = $r->shopee;
        }
        $productExtra->save();
        return redirect()->route('editDone');
    }

    public function editdones()
    {
        return view('editDone');
    }

    public function details($id){
        $productDetails=Product::find($id);
        $productExtra = ProductsExtra::where('name', $productDetails->name)->first();
        return view('productDetails', ['products' => $productDetails, 'productExtra' => $productExtra]);
    }

    public function search(){
        $r=request();
        $keyword=$r->keyword;
        $product=DB::table('products')->where('name','like','%'.$keyword.'%')->paginate(10);
        return view('showAllProduct')->with(['products' => $product, 'keyword' => $keyword]);   //Select * from products where name like '%$keyword%'
    }
}
?>