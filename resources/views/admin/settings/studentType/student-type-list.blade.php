@extends('admin.admin_layouts')
@section('admin_content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Student Type list
                            <button class="bg-success text-light" data-toggle="modal" data-target="#studentTypeAddModel">Add New</button>
                        </h4>
                    </div>
                </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Class Name</th>
                        <th>Student Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="studentTypeTable">

                        @include('admin.settings.studentType.student-type-table')

                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </section>
    <!--Content End-->
    @include('admin.settings.studentType.model.add-form')
    @include('admin.settings.studentType.model.edit-form')

@endsection
          

<script>
        {{-- Data Add with ajax Not Work --}}

    $('#studentTypeInsert').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var method = $(this).attr('method');
        $('#studentTypeAddModel #reset').click();
        $('#studentTypeAddModel').modal('hide');
        $.ajax({
            data : data,
            type : method,
            url  : url,
            success: function() {
                $.get("{{ route('studenttypes.index') }}", function (data) {
                    $('#studentTypeTable').empty().html(data);
                })
            }
        })
    });
            {{-- Data Inactive --}}

    function Unpublish(id) {
        $.get("{{ Route('studenttypes.unpublish') }}", { type_id:id}, function (data) {
            console.log(data);
            $('#studentTypeTable').empty().html(data);
        });
    }

            {{-- Data Active --}}
    function Publish(id) {
        $.get("{{ Route('studenttypes.publish') }}", { type_id:id}, function (data) {
            console.log(data);
            $('#studentTypeTable').empty().html(data);
        });
    }   

            {{-- Data Edit --}}    
    function StudentTypeEdit(id,name) {
        $('#studentTypeEditModel').find('#StudentType').val(name);
        $('#studentTypeEditModel').find('#typeId').val(id);
        $('#studentTypeEditModel').modal('show');
     } 
            {{--Data Update Not Work--}} 

    $('#studentTypeUpdate').submit(function (e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var method = $(this).attr('method');
        $('#studentTypeAddModel #reset').click();
        $('#studentTypeAddModel').modal('hide');
        $.ajax({
            type : method,
            url  : url,
            data : data,
            success: function() {
               $('#studentTypeTable').empty().html(data);
            }
        })
    });

            {{--Data Delete--}} 
    function StudentTypeDelete(id) {
        var msg = 'If you want to Delete this item Press OK';
        if (confirm(msg)) {
            $.get("{{ route('studenttypes.delete') }}", { type_id:id}, function (data) {
            console.log(data);
            $('#studentTypeTable').empty().html(data);
            });
        }
    }
</script>
    
