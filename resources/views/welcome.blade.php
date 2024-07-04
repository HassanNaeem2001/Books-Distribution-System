<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
       <div class="container my-4">
        <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12 my-2">
            <b>Select Batch : </b>
        <select name="" id="batchlist" class="form-control form-select">
            <option value="" selected disabled>Select Batch</option>
            @foreach($batches as $b)
            <option value="{{$b->id}}">{{$b->Batch}}</option>
            @endforeach
         </select>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-12 my-2">
        <b>Select Semester : </b>
        <select name="" id="semesterlist" class="form-control form-select" disabled>
            <option value="" selected disabled>Select Semester</option>
            @foreach($semesters as $s)
            <option value="{{$s->id}}">{{$s->Sem_Name}}</option>
            @endforeach
         </select>
        </div>
        <!-- <div class="col-lg-4 col-sm-12 col-md-12 my-2">
        <b>Select Curriculum : </b>
        <select name="" id="currlist" class="form-control form-select" disabled>
            <option value="" selected disabled>Select Curriculum</option>
            @foreach($curriculums as $c)
            <option value="{{$c->id}}">{{$c->Curr_Name}}</option>
            @endforeach
         </select>
        </div> -->
    
        </div>
       </div>
       <br>
     
      <div class="container">
      <div class="row">
        <div class="col-10">
        <h3>Students Record</h3>
        </div>
       
       
      </div>
      <hr>
      <!-- <div
        class="table-responsive"
       >
        <table
            class="table table-striped"
        >
            <thead>
                <tr id="skills">
                 
                </tr>
                <tbody id="tablebody">
                     
                </tbody>
            </thead>
            
        </table>
       </div>
      </div> -->
      <div class="container" id="skills">

      </div>
       
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script>
            var curriculumlist = document.getElementById('currlist')
            var semesterlist = document.getElementById('semesterlist')
            var batchlist = document.getElementById('batchlist')
            $('#batchlist').change(function(){
                semesterlist.disabled=false
            })
           
            $('#semesterlist').change(function(){
                
                var semesterid = $('#semesterlist').val();
                var batchid = $('#batchlist').val();
                $.ajax({

                    url:"/getskills",
                    type:"POST",
                    data:{
                        
                        "SemId":semesterid,
                        "BatchId":batchid,
                        "_token":"{{csrf_token()}}"
                    },
                    success:function(data){
                        $('#skills').html(data);
                        
                    }
                })
            })
           
        $(document).ready(function() {
        $(document).on('change', '#skillcheck', function() {
        var studentid = $(this).data('studentid');
        var skill = $(this).data('skill');
        var status = $(this).prop('checked')
        if(status == true)
        {
            // console.log("Student ID: " + studentid + ", Skill: " + skill+" "+"Checked");
            $.ajax({
                url:"insertrec",
                type:"POST",
                data:{
                    studentid:studentid,
                    skill:skill,
                    status:"Given",
                    "_token":"{{csrf_token()}}"
                },
                success:function(){
                    alert("Status Changed");
                }
            })
        }
        
        
    });
});

        </script>
    </body>
</html>
