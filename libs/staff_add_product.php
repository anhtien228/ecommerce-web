<style>
    .wrapper {
        height: auto !important;
        margin-top: 0px !important;
    }
</style>

<div class="wrapper">
    <div class="form">
        <!-- USER REGISTER -->
        <div id="user_register">
            <form method="post" action="libs/product/staff_add_item.php" id="add-item" onsubmit="return register_validation();">
                <div class="input_wrap">
                    <label for="input_firstname">Product name</label>
                    <div class="input_field">
                        <input type="text" class="input" id="input_product_name" name="product_name" placeholder="Enter product name" required />
                        <!-- <input type="text" class="input" id="input_username" name="user_name"/> -->
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="input_lastname">SKU code</label>
                    <div class="input_field">
                        <input type="text" class="input" id="input_sku" name="product_sku" placeholder="Enter your SKU code" required />
                        <!-- <input type="text" class="input" id="input_username" name="user_name"/> -->
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="input_username">CPU</label>
                    <div class="input_field">
                        <input type="text" class="input" id="input_cpu" name="product_cpu" placeholder="Enter CPU" required />
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="input_username">Brand</label>
                    <select id="input_brand" name="product_brand">
                        <option value="1">Lenovo</option>
                        <option value="2">Asus</option>
                        <option value="3">Dell</option>
                        <option value="4">HP</option>
                        <option value="5">Acer</option>
                        <option value="6">Apple</option>
                    </select>
                </div>
                <div class="input_wrap">
                    <label for="input_username">RAM</label>
                    <select id="input_ram" name="product_ram">
                        <option value="2 GB">2 GB</option>
                        <option value="4 GB">4 GB</option>
                        <option value="8 GB">8 GB</option>
                        <option value="16 GB">16 GB</option>
                        <option value="32 GB">32 GB</option>
                    </select>
                </div>
                <div class="input_wrap">
                    <label for="input_username">Storage</label>
                    <select id="input_storage" name="product_storage">
                        <option value="64 GB">64 GB</option>
                        <option value="128 GB">128 GB</option>
                        <option value="256 GB">256 GB</option>
                        <option value="512 GB">512 GB</option>
                        <option value="1 TB">1 TB</option>
                        <option value="2 TB">2 TB</option>
                    </select>
                </div>
                <div class="input_wrap">
                    <label for="input_username">Graphic</label>
                    <div class="input_field">
                        <input type="text" class="input" id="input_graphic" name="product_graphic" placeholder="Enter graphic" required />
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="input_username">Price</label>
                    <div class="input_field">
                        <input type="number" class="input" id="input_price" name="product_price" placeholder="Enter price" required />
                    </div>
                </div>
                <div class="input_wrap">
                    <label for="input_username">Photo</label>
                    <div class="input_field">
                        <input type="text" class="input" id="input_photo" name="product_photo" placeholder="Enter photo link" required />
                    </div>
                </div>
                <div class="input_wrap">
                    <input type="submit" id="login_btn" name="User" class="btn enabled" value="Add product" form="add-item">
                </div>
        </div>
        </form>
    </div>
</div>