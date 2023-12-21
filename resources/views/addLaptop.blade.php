@extends('adminLayout')
@section('content')
<style>
.center-container{
  display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* This ensures the form is centered vertically on the viewport /
    background-color: #f7f7f7; / Example background color, adjust as needed */
}

.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  background-color: #fff;
  padding: 20px;
  border-radius: 20px;
  position: relative;
  justify-content: center;
}

.title {
  font-size: 28px;
  color: royalblue;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: royalblue;
}

.title::before {
  width: 18px;
  height: 18px;
  background-color: royalblue;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.message, .signin {
  color: rgba(88, 87, 87, 0.822);
  font-size: 14px;
}

.signin {
  text-align: center;
}

.signin a {
  color: royalblue;
}

.signin a:hover {
  text-decoration: underline royalblue;
}

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  position: relative;
}

.form-select{
  width: 120%;
  padding: 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;

}
.form label .form-control {
  width: 100%; /* 保持输入框宽度为100% */
  padding: 10px; /* 调整内边距 */
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .form-control {
  width: 100%;
  padding: 10px 10px 20px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .form-control + span {
  position: absolute;
  left: 10px;
  top: 15px;
  color: grey;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .form-control:placeholder-shown + span {
  top: 15px;
  font-size: 0.9em;
}

.form label .form-control:focus + span,.form label .form-control:valid + span {
  top: 30px;
  font-size: 0.7em;
  font-weight: 600;
}

.form label .form-control:valid + span {
  color: green;
}

.submit {
  border: none;
  outline: none;
  background-color: royalblue;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
}

.submit:hover {
  background-color: rgb(56, 90, 194);
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}
</style>
<script>
    function updateBrandName(select) {
        const selectedOption = select.options[select.selectedIndex];
        const brandNameContainer = document.getElementById('brandNameContainer');

        if (selectedOption && brandNameContainer) {
            const brandName = selectedOption.text;
            brandNameContainer.textContent = brandName;
        }
    }
</script>

<div class="center-container">
<form class="form" action="{{ route('addLaptop') }}" method="POST" enctype="multipart/form-data">@csrf
    <p class="title">Add Laptop </p>
    <p class="message">Add a new laptop to our app. </p>
        <div class="flex">
        <label>
            <input name="laptopName" type="text" class="form-control" required="" placeholder="">
            <span>Laptop Name</span>
        </label>
        
        <label>
            <select name="manufacturer" class="form-select" required="" onchange="updateBrandName(this)">
                <option value="" disabled selected>Select Manufacturer</option>
                <option value="apple">Apple</option>
                <option value="asus">Asus</option>
                <option value="lenovo">Lenovo</option>
                <option value="microsoft">Microsoft</option>
                <option value="msi">MSI</option>
                <option value="acer">Acer</option>
                <option value="dell">Dell</option>
                <option value="hp">HP</option>
                <!-- Add more brand options -->
            </select>
        </label>
    </div>  
            
    <label>
        <input name="price" type="number" class="form-control" required="" placeholder="">
        <span>Price</span>
    </label> 
        
    <label>
        <input name="process_model" type="text" class="form-control" required="" placeholder="">
        <span>Process Model (Apple/Intel/MediaTek)</span>
    </label>
    <label>
        <input name="graphics" type="text" class="form-control" required="" placeholder="">
        <span>Graphics (Appple m1/Intel HD/Radeon RX)</span>
    </label>
    <div class="flex">
        <label>
            <input name="display_technology" type="text" class="form-control" required="" placeholder="">
            <span>Display Technology (ICD/OLED/IPS/TN/VA)</span>
        </label>

        <label>
            <input name="screen_size" type="text" class="form-control" required="" placeholder="">
            <span>Screen Size (12-inch/15.6-inch)</span>
        </label>
        <label>
            <input name="screen_resolution" type="text" class="form-control" required="" placeholder="">
            <span>Screen Resolution (1920x1080/2560x1600)</span>
        </label>
    </div>

    <div class="flex">
        <label>
            <input name="storage" type="text" class="form-control" required="" placeholder="">
            <span>Storage (128GB/512GB)</span>
        </label>

        <label>
            <input name="memory" type="text" class="form-control" required="" placeholder="">
            <span>Memory (12GB/32GB)</span>
        </label>
    </div>
    
    <label>
      <input name="operating_system" type="text" class="form-control" required="" placeholder="">
      <span>Operating System (Windows 11)</span>
    </label>
    
    <label>
        <input name="connectivity" type="text" class="form-control" required="" placeholder="">
        <span>Connecivity</span>
    </label>
    <label>
        <input name="camera" type="text" class="form-control" required="" placeholder="">
        <span>Camera</span>
    </label>
    <label>
        <input name="ports" type="text" class="form-control" required="" placeholder="">
        <span>Ports</span>
    </label>
    <label>
        <input name="battery" type="text" class="form-control" required="" placeholder="">
        <span>Battery (5000)</span>
    </label>

    <div class="flex">
        <label>
            <input name="height" type="text" class="form-control" required="" placeholder="">
            <span>Height</span>
        </label>

        <label>
            <input name="width" type="text" class="form-control" required="" placeholder="">
            <span>Width</span>
        </label>
        <label>
            <input name="depth" type="text" class="form-control" required="" placeholder="">
            <span>Depth</span>
        </label>
    </div>

    <div class="flex">
        <label>
            <input name="weight" type="text" class="form-control" required="" placeholder="">
            <span>Body Weight</span>
        </label>
        <div class="flex"> 
      <label>
        <select name="type" class="form-select" required="" onchange="updateBrandName(this)">
          <option value="" disabled selected>Select Laptop Type</option>
          <option value="chromebook">Chromebook</option>
          <option value="gaming-laptop">Gaming Laptop</option>
          <option value="laptop-10-13">Laptop 10-13</option>
          <option value="laptop-14-16">Laptop 14-16</option>
          <option value="laptop-17">Laptop 17</option>
          <option value="macbook-air">MacBook Air</option>
          <option value="macbook-pro">MacBook Pro</option>
          <option value="macbook">MacBook</option>
          <option value="thinkpad">ThinkPad</option>
          <option value="windows-laptop">Windows Laptop</option>
          <!-- Add more brand options -->
        </select>
      </label>
    </div>   

    <div class="flex"> 
      <label>
        <select name="filter" class="form-select" required="" onchange="updateBrandName(this)">
          <option value="" disabled selected>Select Filter Type</option>
          <option value="it">Engineering and Computer Science</option>
          <option value="art">Design and Fine Arts</option>
          <option value="business">Business and Finance</option>
          <option value="office">Office</option>
          <option value="education">Education and Educational Technology</option>
          <!-- Add more brand options -->
        </select>
      </label>
    </div>
    </div>    
    <label>
        <input name="imageName" type="file" class="form-control" placeholder="" required="" placeholder="">
        
    </label>
    
    

    <div class="flex">
        <label>
            <input name="lazada" type="url" class="form-control"  placeholder="">
            <span>Lazada</span>
        </label>

        <label>
            <input name="shopee" type="url" class="form-control"  placeholder="">
            <span>Shopee</span>
        </label>
    </div>
    <button class="submit">Submit</button>
</form>
  </div>
@endsection