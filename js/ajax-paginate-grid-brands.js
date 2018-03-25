$(document).ready(function(){
    /* Declare Global variables */
    var current_page_id = 1;
    var num_pages = 1;
    var records_per_page = 3;

    get_num_pages(); // update num_pages
    load_data(current_page_id); // initialize

    function load_data(page) {
        $.ajax({
            url:"../database/shoe_grid_show.php",
            method:"POST",
            data:{page:page, records:records_per_page},
            success:function(data){
                $('#products-list').html(data);

                var btnPrev = document.getElementById('prev-page');
                var btnNext = document.getElementById('next-page');
                var btnCurr = document.getElementById(page);

                if(page == 1) {
                    btnPrev.disabled = true;
                    btnNext.disabled = false;
                }
                else if(page == num_pages) {
                    btnPrev.disabled = false;
                    btnNext.disabled = true;
                }

                btnCurr.classList.add('btn-primary');
            }
        })
    }

    function get_num_pages() {
        $.ajax({
            url:"../database/shoe_num_rows.php",
            method:"POST",
            data:{records:records_per_page},
            success:function(data){
                num_pages = data;
            }
        })
    }

    function load_prev_page(pageID) {
        setCurrentPageID(pageID - 1);
        load_data(pageID - 1);
    }

    function load_next_page(pageID) {
        setCurrentPageID(pageID + 1);
        load_data(pageID + 1);
    }

    function setCurrentPageID(pageID) {
        current_page_id = pageID;
    }

    /*********************************************/

    // Current Page Button
    $(document).on('click', '.pagination-link', function() {
        var page = $(this).attr("id");
        setCurrentPageID(parseInt(page));
        load_data(page);
    });

    // Previous Button
    $(document).on('click', '#prev-page', function() {
        load_prev_page(current_page_id);
    });

    // Next Button
    $(document).on('click', '#next-page', function() {
        load_next_page(current_page_id);
    });
});