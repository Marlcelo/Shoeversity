<div class="modal fade" id="rating_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
             <!-- Modal Header -->
            <div class="modal-header" style="background: #37474F; color: #fff; border-radius: 5px 5px 0 0">
                <button type="button" class="close" 
                   data-dismiss="modal" style="color: #fff">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Rate Product
                </h4>
            </div>

            <form action="../../database/shoe_rate.php" method="post">
                <div class="modal-body">
                    <div class="ratings text-center" style="font-size: 25px">
                        <button type="button" style="background: none; border: none" name="1" 
                            onclick="showStars(1, this);">
                            <span id="1" class="glyphicon glyphicon-star-empty"></span>
                        </button>

                        <button type="button" style="background: none; border: none" name="2" 
                            onclick="showStars(2, this);">
                            <span id="2" class="glyphicon glyphicon-star-empty"></span>
                        </button>

                        <button type="button" style="background: none; border: none" name="3" 
                            onclick="showStars(3, this);">
                            <span id="3" class="glyphicon glyphicon-star-empty"></span>
                        </button>

                        <button type="button" style="background: none; border: none" name="4" 
                            onclick="showStars(4, this);">
                            <span id="4" class="glyphicon glyphicon-star-empty"></span>
                        </button>

                        <button type="button" style="background: none; border: none" name="5" 
                            onclick="showStars(5, this);">
                            <span id="5" class="glyphicon glyphicon-star-empty"></span>
                        </button>
                    </div>
                </div>
                   
                <!-- Modal Footer -->
                <div class="modal-footer" style="border-top: none">
                    <button type="button" class="btn bnt-default" style="background: #eee" onclick="resetRating()">
                        <strong>Reset</strong>
                    </button>
                    &nbsp;
                    <button type="button" name="submit" class="btn btn-info" onclick="rateShoe()">
                        <strong>Submit Rating</strong>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/Javascript">
    var finalRating = 0;

    function showStars(id, btn) {
        btn.blur(); 

        var i;

        // remove all stars
        for(i = 1; i <= 5; i++) {
            $("#" + i.toString()).addClass("glyphicon-star-empty");
        }

        // add shading to stars
        for(i = 1; i <= 5; i++) {
            if(i <= id) {
                $("#" + i.toString()).removeClass("glyphicon-star-empty").addClass("glyphicon-star");
            }
            else {
                break;
            }
        }
        finalRating = i - 1;
    }

    function resetRating() {
        for(var i = 1; i <= 5; i++) {
            $("#" + i.toString()).addClass("glyphicon-star-empty");
        }

        finalRating = 0;
    }

    function rateShoe() {
        $.ajax({
            url:"../../database/shoe_rate.php",
            method:"POST",
            data:{rating:finalRating},
            success:function(success_msg){
                // $('#rating_modal').modal('toggle'); 

                // open success modal
                $('#success_modal').modal('show');
            }
        })
    }
</script>