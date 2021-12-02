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
                <label for="brand" class="form-label">Brand Name</label>
                <select class="form-select" aria-label="Default select example" name="brand" id="brand">
                    <option value="all">All</option>
                    <option value="asus">Asus</option>
                    <option value="acer">Acer</option>
                    <option value="lenovo">Lenovo</option>
                    <option value="dell">Dell</option>
                    <option value="apple">Apple</option>
                    <option value="hp">HP</option>
                </select>
            </div>

            <script type="text/javascript">
                document.getElementById('brand').value = "<?php echo $_GET['brand'];?>";
            </script>

            <!--Select OS (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="os" class="form-label">OS</label>
                <select class="form-select" aria-label="Default select example" name="os" id="os">
                    <option value="all">All</option>
                    <option value="windows">Windows</option>
                    <option value="mac">Mac OS</option>
                </select>
            </div>

            <script type="text/javascript">
                document.getElementById('os').value = "<?php echo $_GET['os'];?>";
            </script>

            <!--Select CPU (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="cpu" class="form-label">CPU</label>
                <select class="form-select" aria-label="Default select example" name="cpu" id="cpu">
                    <option value="all">All</option>
                    <option value="i3">i3</option>
                    <option value="i5">i5</option>
                    <option value="i7">i7</option>
                    <option value="AMD">AMD</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <script type="text/javascript">
                document.getElementById('cpu').value = "<?php echo $_GET['cpu'];?>";
            </script>
            
            <!--Select RAM (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="ram" class="form-label">RAM</label>
                <select class="form-select" aria-label="Default select example" name="ram" id="ram">
                    <option value="all">All</option>
                    <option value="2gb">2 GB</option>
                    <option value="4gb">4 GB</option>
                    <option value="8gb">8 GB</option>
                    <option value="16gb">16 GB</option>
                    <option value="32gb">32 GB</option>
                </select>
            </div>

            <script type="text/javascript">
                document.getElementById('ram').value = "<?php echo $_GET['ram'];?>";
            </script>

            <!--Select Storage (This function does not work at now)-->
            <div class="mb-3 col-lg-2">
                <label for="storage" class="form-label">Storage</label>
                <select class="form-select" aria-label="Default select example" name="storage" id="storage">
                    <option value="all">All</option>
                    <option value="32gb">32 GB</option>
                    <option value="64gb">64 GB</option>
                    <option value="128gb">128 GB</option>
                    <option value="256gb">256 GB</option>
                    <option value="512gb">512 GB</option>
                    <option value="1tb">1 TB</option>
                    <option value="2tb">2 TB</option>
                </select>
            </div>

            <script type="text/javascript">
                document.getElementById('storage').value = "<?php echo $_GET['storage'];?>";
            </script>

            <!--Select price (This function does not work at now)-->
            <div class="mb-3 col-lg-1">
                <label for="min-price" class="form-label">Min Price</label>
                <input type="number" class="form-control" name="min-price" min="0" id="min-price" placeholder="Min">
            </div>

            <script type="text/javascript">
                document.getElementById('min-price').value = "<?php echo $_GET['min-price'];?>";
            </script>

            <div class="mb-3 col-lg-1">
                <label for="max-price" class="form-label">Max Price</label>
                <input type="number" class="form-control" name="max-price" min="0" id="max-price" placeholder="Max">
            </div>

            <script type="text/javascript">
                document.getElementById('max-price').value = "<?php echo $_GET['max-price'];?>";
            </script>

            <!--Submit button-->
            <div class="mb-3 col-lg-1">
                <button type="submit" name="submit_filter" class="btn-custom"><span>Select</span></button>
            </div>
            <div class="mb-3 col-lg-1">
                <button type="button" name="reset_filter" class="btn-custom" onclick="clearFilter()"><span>Clear</span></button>
            </div>

            <script type="text/javascript">
                function clearFilter() {
                    document.getElementById("filter-tab").reset();
                    document.getElementById("filter-tab").submit();
                }
            </script>
        </div>
    </form>
    
</div>