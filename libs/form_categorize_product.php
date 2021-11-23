<!--Form-->
<style>
    #filter-tab {
        font-family: 'Gilroy Regular';
    }

    #filter-tab label {
        font-family: 'Gilroy Medium';
    }

</style>

<div>
    <form id="filter-tab" action="" method="GET">
        <div class="row">
            <!--Select brand-->
            <div class="mb-3 col-lg-2">
                <label for="formGroupExampleInput" class="form-label">Brand Name</label>
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
            <div class="mb-3 col-lg-2">
                <label for="formGroupExampleInput" class="form-label">OS</label>
                <select class="form-select" aria-label="Default select example" name="os">
                    <option value="all">All</option>
                    <option value="windows">Windows</option>
                    <option value="mac">Mac OS</option>
                </select>
            </div>

            <!--Select CPU (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="formGroupExampleInput" class="form-label">CPU</label>
                <select class="form-select" aria-label="Default select example" name="cpu">
                    <option value="all">All</option>
                    <option value="i3">i3</option>
                    <option value="i5">i5</option>
                    <option value="i7">i7</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <!--Select RAM (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="formGroupExampleInput" class="form-label">RAM</label>
                <select class="form-select" aria-label="Default select example" name="ram">
                    <option value="all">All</option>
                    <option value="2 gb">2 GB</option>
                    <option value="4 gb">4 GB</option>
                    <option value="8 gb">8 GB</option>
                    <option value="16 gb">16 GB</option>
                    <option value="32 gb">32 GB</option>
                </select>
            </div>

            <!--Select Storage (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="formGroupExampleInput" class="form-label">Storage</label>
                <select class="form-select" aria-label="Default select example" name="storage">
                    <option value="all">All</option>
                    <option value="64 gb">64 GB</option>
                    <option value="128 gb">128 GB</option>
                    <option value="256 gb">256 GB</option>
                    <option value="512 gb">512 GB</option>
                    <option value="1 tb">1 TB</option>
                    <option value="2 tb">2 TB</option>
                </select>
            </div>

            <!--Select price (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="customRange3" class="form-label">Price:</label>
                <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
            </div>

            <!--Submit button-->
            <div class="mb-3">
                <button type="submit" name="submit_filter" class="btn-custom"><span>Select</span></button>
            </div>
        </div>


    </form>
</div>