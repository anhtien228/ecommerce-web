<!--Form-->
<div>
    <form action="/user_index.php" method="get">
        <div class="row">
            <!--Select brand-->
            <div class="mb-3 col-lg-3">
                <label for="formGroupExampleInput" class="form-label">Brand Name:</label>
                <select class="form-select" aria-label="Default select example" name="brand">
                    <option value="all">All</option>
                    <option value="asus">Asus</option>
                    <option value="acer">Acer</option>
                    <option value="lenovo">Lenovo</option>
                    <option value="dell">Dell</option>
                    <option value="apple">Apple</option>
                    <option value="hp">HP</option>
                </select>
            </div>

            <!--Select OS (This function does not work at now)-->
            <div class="mb-3 col-lg-3">
                <label for="formGroupExampleInput" class="form-label">OS:</label>
                <select class="form-select" aria-label="Default select example" name="os">
                    <option selected>All</option>
                    <option value="windows">Windows</option>
                    <option value="mac">Mac OS</option>
                </select>
            </div>

            <!--Select price (This function does not work at now)-->
            <div class="mb-3 col-lg-6">
                <label for="customRange3" class="form-label">Price:</label>
                <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
            </div>

            <!--Submit button-->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Select</button>
            </div>
        </div>


    </form>
</div>