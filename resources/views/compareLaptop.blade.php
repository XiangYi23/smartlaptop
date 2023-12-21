@extends('layout')
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

    /* New styles for the carousel */
    .first-laptop {
        display: flex; 
        flex-direction: column;
    }

    .selected-laptop {
        flex: 1; 
    }

    .carousel {
        flex: 1; 
    }

    @php
        $comparisonLaptops = $comparisonLaptops ?? collect([]);
        if (!is_countable($comparisonLaptops)) {
            $comparisonLaptops = collect([]);
        }
    @endphp

    .comparison-details {
        width: 100%; /* You can adjust this value */
        box-sizing: border-box; /* to include padding and border */
    }

    .search-bar,
    .search-bar2, 
    .search-bar3{
        display: flex;
        justify-content: flex-start;
        align-items: center; 
        flex-direction: column;
        position: sticky;
        top: -1px;
        z-index: 9;
    }

    .search-input {
        padding: 10px;
        padding-right: 40px; /* Make space for the search icon inside the input */
        font-size: 16px;
        border: 2px solid #007BFF;
        border-radius: 5px;
        outline: none;
        width: 60%; /* Take full width of the container */
        box-sizing: border-box; /* Include padding and border in width */
    }

    .search-button {
        background-color: transparent; /* Transparent background */
        border: none;
        position: absolute; /* To position inside the search-input */
        right: 125px; /* Space from the right edge of the input field */
        top: 20px; /* Position it at the middle vertically */
        transform: translateY(-50%); /* Center the button vertically */
        color: #007BFF; /* Color of the search icon */
        font-size: 18px;
        cursor: pointer;
        outline: none; /* Remove focus outline */
    }

    .compare-row {
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: space-around;
    }

    .searchResults {
        position: absolute;
        background-color: #fff;
        z-index: 9;
        top: 45px;
        border: 1px solid;
        border-radius: 6px;
    }
    @media only screen and (max-width: 480px) {
        .search-bar3{
            display: none;
        }
        .search-button {
            right:0px;
        }
        .searchResults {
            position: absolute;
            background-color: azure;
            z-index: 2;
            top: 30px;
            border: 1px solid;
            border-radius: 6px;
        }
    }
</style>

<div class="title-container">
    <h2 class="title">Compare Laptops</h2>
</div>


<div class="comparison-container">

    <div class="compare-row">
        <div class="search-bar  col-md-4 col-6">
            <input type="hidden" class="laptop_id_1" value="{{ $laptop->id }}">

            <input type="text" id="laptopSearchInput1" name="keyword" class="laptopSearchInput1 search-input" placeholder="Search for a laptop..." >
            <button type="button" class="search-button" onclick="searchLaptops('searchResults1', 'laptop_id_1', 'laptopSearchInput1')">&#128269;</button>
            <div id="searchResults1" class="searchResults"></div>
            <div id="selectedLaptop1"></div>
        </div>

        <div class="search-bar2 col-md-4 col-6">
            <input type="hidden" class="laptop_id_2" value="{{ $laptop->id }}">

            <input type="text" id="laptopSearchInput2" name="keyword" class="laptopSearchInput2 search-input" placeholder="Search for a laptop...">
            <button type="button" class="search-button" onclick="searchLaptops('searchResults2', 'laptop_id_2', 'laptopSearchInput2')">&#128269;</button>
            <div id="searchResults2" class="searchResults"></div>
            <div id="selectedLaptop2"></div>
        </div>

        <div class="search-bar3 col-md-4">
            <input type="hidden" class="laptop_id_3" value="{{ $laptop->id }}">

            <input type="text" id="laptopSearchInput3" name="keyword" class="laptopSearchInput3 search-input" placeholder="Search for a laptop...">
            <button type="button" class="search-button" onclick="searchLaptops('searchResults3', 'laptop_id_3', 'laptopSearchInput3')">&#128269;</button>
            <div id="searchResults3" class="searchResults"></div>
            <div id="selectedLaptop3"></div>
        </div>
       
    </div>
    
    <!-- Laptops display -->
    <div class="laptop-container">
        

        <div class="compare-row" id="selectedLaptopsContainer">
            <!-- Selected laptops will be displayed here -->
            
        </div>
        
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
     // Set the initial values for selectedLaptop1 when the page loads
     $(document).ready(function () {
        var laptop = @json($laptop); // Convert the PHP variable to a JSON object

        // Call a function to set the selected laptop
        selectLaptop('selectedLaptop1', laptop.id, laptop.manufacturer, laptop.name, laptop.price, laptop.image, laptop.process_model, laptop.graphics, laptop.display_technology, laptop.screen_size, laptop.screen_resolution, laptop.memory, laptop.storage, laptop.operating_system, laptop.connectivity, laptop.camera, laptop.ports, laptop.battery, laptop.height, laptop.width, laptop.depth, laptop.weight, laptop.type);
    });


    function searchLaptops(resultContainerId, laptopId, searchInputId) {
    var keyword = $('#' + searchInputId).val();     
    console.log(keyword);
    var laptop_id = $('#' + laptopId).val();
    $.ajax({
        url: '/compareLaptop/search',
        method: 'GET',
        data: { keyword: keyword },
        success: function (data) {
            
            // Update the corresponding search results area
            $('#' + resultContainerId).empty();
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var laptop = data[i];
                    var resultHtml = '<div class="search-result" onclick="selectLaptop(\'' + resultContainerId + '\', \'' + laptop.id + '\', \'' + laptop.manufacturer + '\', \'' + laptop.name + '\', \'' + laptop.price + '\', \'' + laptop.image + '\', \'' + laptop.process_model + '\', \'' + laptop.graphics + '\', \'' + laptop.display_technology + '\', \'' + laptop.screen_size + '\', \'' + laptop.screen_resolution + '\', \'' + laptop.memory + '\', \'' + laptop.storage + '\', \'' + laptop.operating_system + '\', \'' + laptop.connectivity + '\', \'' + laptop.camera + '\', \'' + laptop.ports + '\', \'' + laptop.battery + '\', \'' + laptop.height + '\', \'' + laptop.width + '\', \'' + laptop.depth + '\', \'' + laptop.weight + '\', \'' + laptop.type + '\')">' +
                                        '<h3>' + laptop.manufacturer + ' ' + laptop.name + '</h3>' +
                                        '<p>RM' + laptop.price + '</p>' +
                                     '</div>';
                    $('#' + resultContainerId).append(resultHtml);
                }
            } else {
                // Handle the case where no laptops are found
                $('#' + resultContainerId).html('<p>No laptops found.</p>');
            }
        }
    });
}


function selectLaptop(containerId,id,manufacturer, name, price, image,process_model,graphics,display_technology,screen_size,screen_resolution,memory,storage,operating_system,connectivity,camera,ports,battery,height,width,depth,weight,type,filter) {
    var laptopDetailUrl = '/laptopDetails/' + encodeURIComponent(id);

    var html = `<div class="compare-row">
                    <div class="first-laptop">
                        <img src="{{ asset('images/') }}/${image}" class="laptop-image" alt="">
                        <a href="${laptopDetailUrl}"><h3>${manufacturer} ${name}</h3></a>
                        <p>RM${price}</p>
                    </div>
                </div>
                <div class="compare-row">
                    <div class="first-laptop">
                        <!-- Display the original chosen laptop for comparison -->
                        <div class="selected-laptop comparison-details">
                            <!-- Specifications Table for Original Laptop -->
                            <table class="performance">
                                <tr>
                                    <th class="non">Manufacturer</th>
                                    <td>${manufacturer}</td>
                                </tr>
                                <tr>
                                    <th class="non">Process</th>
                                    <td> ${process_model}</td>
                                </tr>   
                                <tr>
                                    <th class="non">Graphics</th>
                                    <td> ${graphics}</td>
                                </tr>
                                <tr>
                                    <th class="non">Display Technology</th>
                                    <td> ${display_technology}</td>
                                </tr>
                                <tr>
                                <th class="non">Screen Size</th>
                                    <td> ${screen_size}</td>
                                </tr>
                                <tr>
                                <th class="non">Screen Resolution</th>
                                <td> ${screen_resolution}</td>
                                </tr>
                                <tr>
                                <th class="non">Storage</th>
                                <td> ${storage}</td>
                                </tr>
                                <tr>
                                <th class="non">Memory</th>
                                <td> ${memory}</td>
                                </tr>
                                <tr>
                                <th class="non">Operating System</th>
                                <td> ${operating_system}</td>
                                </tr>
                                <tr>
                                <th class="non">Connectivity</th>
                                <td> ${connectivity}</td>
                                </tr>
                                <tr>
                                <th class="non">Camera</th>
                                <td> ${camera}</td>
                                </tr>
                                <tr>
                                <th class="non">Ports</th>
                                <td> ${ports}</td>
                                </tr>
                                <tr>
                                <th class="non">Battery</th>
                                <td> ${battery}</td>
                                </tr>
                                <th class="non">Height</th>
                                <td> ${height}</td>
                                </tr>
                                <tr>
                                <th class="non">Width</th>
                                <td> ${width}</td>
                                </tr>
                                <tr>
                                <th class="non">Depth</th>
                                <td> ${depth}</td>
                                </tr>
                                <tr>
                                <th class="non">Weight</th>
                                <td> ${weight}</td>
                                </tr>
                                <tr>
                                <th class="non">Type</th>
                                <td> ${type}</td>
                                </tr>
                            </table>
                        </div>
                </div>
                `;

    $('#' + 'selectedLaptop' + containerId.charAt(containerId.length - 1)).html(html);
    
    $('#searchResults' + containerId.charAt(containerId.length - 1)).empty();
}
</script>
@endsection