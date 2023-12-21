@extends('adminLayout')
@section('content')

<!-- Styles -->
<style>
    .title-container {
        text-align: center; 
        margin-top: -8px; /* Move the title slightly up */
        padding: 10px 20px; /* Padding around the container for better appearance */
    }

    .title {
        color: blue;
        display: inline-block; /* Makes the border wrap around the text */
        border: 2px solid #007BFF; /* A blue border */
        padding: 10px 20px; /* Padding around the text for better appearance */
        border-radius: 10px; /* Rounded corners for a modern look */
    }

    .comparison-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .laptop-image {
        width: 200px;
        height: 200px;
        object-fit: contain; 
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .performance {
        flex-grow: 1;
    }

    .performance th,
    .performance td {
        background-color: #f5f5f5;
        padding: 8px;
        text-align: left;
        border-top: 2px solid;
        position: relative;
    }

    h3, p {
        flex-shrink: 0;
        text-align: center;
    }

    p{
        font-weight: bolder;
        font-size: 30px;
        font-family: Arial, Helvetica, sans-serif;
    }


    .slider-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
        font-size: 24px;
        cursor: pointer;
    }

    .slider-button.prev {
        left: 10px;
    }

    .slider-button.next {
        right: 10px;
    }

    /* New styles for the carousel */
    .slider-container {
        display: flex; 
    }

    .selected-laptop {
        flex: 1; 
    }

    .carousel {
        flex: 1; 
        overflow: hidden; 
    }

    @php
        $comparisonLaptops = $comparisonLaptops ?? collect([]);
        if (!is_countable($comparisonLaptops)) {
            $comparisonLaptops = collect([]);
        }
    @endphp

    .carousel-wrapper {
        display: flex; 
        transition: transform 0.3s ease;
        width: calc(100% * {{ count($comparisonLaptops) }});
    }

    .comparison-details {
        width: 100%; /* You can adjust this value */
        box-sizing: border-box; /* to include padding and border */
    }

    .search-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px; /* Space between title and search bar */
        position: relative; /* This will allow us to position the button inside the input */
    }

    .search-input {
        padding: 10px;
        padding-right: 40px; /* Make space for the search icon inside the input */
        font-size: 16px;
        border: 2px solid #007BFF;
        border-radius: 5px;
        outline: none;
        width: 100%; /* Take full width of the container */
        box-sizing: border-box; /* Include padding and border in width */
    }

    .search-button {
        background-color: transparent; /* Transparent background */
        border: none;
        position: absolute; /* To position inside the search-input */
        right: 650px; /* Space from the right edge of the input field */
        top: 50%; /* Position it at the middle vertically */
        transform: translateY(-50%); /* Center the button vertically */
        color: #007BFF; /* Color of the search icon */
        font-size: 18px;
        cursor: pointer;
        outline: none; /* Remove focus outline */
    }

</style>

<div class="title-container">
    <h2 class="title">Compare Laptops</h2>
</div>

<div class="search-bar">
    <form action="{{ route('adminCompareLaptopSearch', ['id' => $laptop->id]) }}" method="POST">
        @csrf
        <input type="text" name="keyword" placeholder="Search for a laptop..." class="search-input">
        <button type="submit" class="search-button">&#128269;</button>
    </form>
</div>

<div class="comparison-container">

    <!-- Slider Previous Button -->
    <button class="slider-button prev">&#10094;</button>

    <!-- Laptops display -->
    <div class="slider-container">
        <!-- Display the original chosen laptop for comparison -->
        <div class="selected-laptop comparison-details">
            <img src="{{ asset('images/') }}/{{ $laptop->image }}" class="laptop-image" alt="">
            <h3>{{ $laptop->manufacturer }} {{ $laptop->name }}</h3>
            <p>RM{{ $laptop->price }}</p>
            <!-- Specifications Table for Original Laptop -->
            <table class="performance">
                <tr>
                    <th class="non">Manufacturer</th>
                    <td>{{ $laptop->manufacturer}}</td>
                </tr>
                <tr>
                    <th class="non">Process</th>
                    <td>{{ $laptop->process_model }}</td>
                </tr>
                <tr>
                    <th class="non">Graphics</th>
                    <td>{{ $laptop->graphics }}</td>
                </tr>
                <tr>
                    <th class="non">Display Technology</th>
                    <td>{{ $laptop->display_technology }}</td>
                </tr>
                <tr>
                <th class="non">Screen Size</th>
                    <td>{{ $laptop->screen_size }}</td>
                </tr>
                <tr>
                <th class="non">Screen Resolution</th>
                <td>{{ $laptop->screen_resolution }}</td>
                </tr>
                <tr>
                <th class="non">Storage</th>
                <td>{{ $laptop->storage }}</td>
                </tr>
                <tr>
                <th class="non">Memory</th>
                <td>{{ $laptop->memory }}</td>
                </tr>
                <tr>
                <th class="non">Operating System</th>
                <td>{{ $laptop->operating_system }}</td>
                </tr>
                <tr>
                <th class="non">Connectivity</th>
                <td>{{ $laptop->connectivity }}</td>
                </tr>
                <tr>
                <th class="non">Camera</th>
                <td>{{ $laptop->camera }}</td>
                </tr>
                <tr>
                <th class="non">Ports</th>
                <td>{{ $laptop->ports}}</td>
                </tr>
                <tr>
                <th class="non">Battery</th>
                <td>{{ $laptop->battery }}</td>
                </tr>
                <th class="non">Height</th>
                <td>{{ $laptop->height }}</td>
                </tr>
                <tr>
                <th class="non">Width</th>
                <td>{{ $laptop->width }}</td>
                </tr>
                <tr>
                <th class="non">Depth</th>
                <td>{{ $laptop->depth }}</td>
                </tr>
                <tr>
                <th class="non">Weight</th>
                <td>{{ $laptop->weight }}</td>
                </tr>
                <tr>
                <th class="non">Type</th>
                <td>{{ $laptop->type }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Carousel for comparison laptops -->
        <div class="carousel">
            <div class="carousel-wrapper">
                @foreach($comparisonLaptops as $compLaptop)
                    <div class="comparison-details">
                        <img src="{{ asset('images/') }}/{{ $compLaptop->image }}" class="laptop-image" alt="">
                        <h3>{{ $compLaptop->manufacturer}} {{ $compLaptop->name }}</h3>
                        <p>RM{{ $compLaptop->price }}</p>
                        <!-- Specifications Table for Comparison Laptops -->
                        <table class="performance">
                        <tr>
                            <th class="non">Manufacturer</th>
                            <td>{{ $compLaptop->manufacturer}}</td>
                        </tr>
                        <tr>
                            <th class="non">Process</th>
                            <td>{{ $compLaptop->process_model }}</td>
                        </tr>
                        <tr>
                            <th class="non">Graphics</th>
                            <td>{{ $compLaptop->graphics }}</td>
                        </tr>
                        <tr>
                            <th class="non">Display Technology</th>
                            <td>{{ $compLaptop->display_technology }}</td>
                        </tr>
                        <tr>
                        <th class="non">Screen Size</th>
                            <td>{{ $compLaptop->screen_size }}</td>
                        </tr>
                        <tr>
                        <th class="non">Screen Resolution</th>
                        <td>{{ $compLaptop->screen_resolution }}</td>
                        </tr>
                        <tr>
                        <th class="non">Storage</th>
                        <td>{{ $compLaptop->storage }}</td>
                        </tr>
                        <tr>
                        <th class="non">Memory</th>
                        <td>{{ $compLaptop->memory }}</td>
                        </tr>
                        <tr>
                        <th class="non">Operating System</th>
                        <td>{{ $compLaptop->operating_system }}</td>
                        </tr>
                        <tr>
                        <th class="non">Connectivity</th>
                        <td>{{ $compLaptop->connectivity }}</td>
                        </tr>
                        <tr>
                        <th class="non">Camera</th>
                        <td>{{ $compLaptop->camera }}</td>
                        </tr>
                        <tr>
                        <th class="non">Ports</th>
                        <td>{{ $compLaptop->ports}}</td>
                        </tr>
                        <tr>
                        <th class="non">Battery</th>
                        <td>{{ $compLaptop->battery }}</td>
                        </tr>
                        <tr>
                        <th class="non">Height</th>
                        <td>{{ $compLaptop->height }}</td>
                        </tr>
                        <tr>
                        <th class="non">Width</th>
                        <td>{{ $compLaptop->width }}</td>
                        </tr>
                        <tr>
                        <th class="non">Depth</th>
                        <td>{{ $compLaptop->depth }}</td>
                        </tr>
                        <tr>
                        <th class="non">Weight</th>
                        <td>{{ $compLaptop->weight }}</td>
                        </tr>
                        <tr>
                        <th class="non">Type</th>
                        <td>{{ $compLaptop->type }}</td>
                        </tr>
                    </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Slider Next Button -->
    <button class="slider-button next">&#10095;</button>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.carousel-wrapper');
    const next = document.querySelector('.slider-button.next');
    const prev = document.querySelector('.slider-button.prev');
    let index = 0;

    next.addEventListener('click', function() {
        index++;
        if (index >= wrapper.children.length) index = 0;
        updateSlider();
    });

    prev.addEventListener('click', function() {
        index--;
        if (index < 0) index = wrapper.children.length - 1;
        updateSlider();
    });

    function updateSlider() {
        // Calculate the offset based on the width of a single comparison laptop
        const offset = -index * 750;  // Move by the width of one item
        wrapper.style.transform = `translateX(${offset}px)`;
    }
});
</script>
@endsection
