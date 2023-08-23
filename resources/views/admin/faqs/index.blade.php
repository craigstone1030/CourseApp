@extends('layouts.admin')

@push("style-alt")
<style>
    .page-title {
        display: inline-block;
    }

    .add-btn {
        float: right;
        font-weight: bold;
        font-size: 25px;
        cursor: pointer;
    }

    div.content {
        font-size: 20px;
    }

    a#trash_btn {
        color: red;
    }

    a#edit_btn {
        color: green
    }

    a#trash_btn,
    a#edit_btn {
        float: right;
    }

</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="page-title">FAQ <i class="fa fa-question-circle" aria-hidden="true"></i></h3>
        <a class="add-btn" data-toggle="modal" data-target="#myModal">+</a>
    </div>
    <div class="card-body">
        @include("admin.faqs.items")
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">FAQ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    <input type="hidden" id="editId" name="editId" value="0" />
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Question:</label>
                            <textarea row="5" col="5" id="question" name="question" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Answer:</label>
                            <textarea row="5" col="5" id="answer" name="answer" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" onClick="submitFrm()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("script-alt")
<script>
    function FormValidate() {

        const question = $("#question").val();
        const answer = $("#answer").val();

        if (question == "" || question == null) {
            toastr.warning("Question is required field!", "Warnning");
            return false;
        } else if (answer == "" || answer == null) {
            toastr.warning("Answer is required field!", "Warnning");
            return false;
        }
        return true;
    }

    function submitFrm() {

        const question = $("#question").val();
        const answer   = $("#answer").val();
        const editId   = $("#editId").val();
        const params   = {question, answer, editId};

        if(FormValidate()) {
            $.post("/admin/faqs/store", params, function( res ) {
                if(res == false){
                    toastr.error("Something went wrong!", "Error");
                } else {
                    $("div.card-body").html(res);
                    toastr.success("FAQ is saved successfully!", "Status");
                    if(editId == 0){
                        clearFrm();
                    }
                    $("#myModal").modal("hide");
                }
            });
        }
    }

    function clearFrm() {
        $("#question").val("");
        $("#answer").val("");
        $("#editId").val(0);
        $("#question").focus();
    }

    function trashItem(faqId) {

        const res = confirm("Are you sure you want to remove this item?");

        if(res){
            $("#faq-"+faqId).remove();
            $.post(`/admin/faqs/${faqId}/remove`, function( res ) {
                $("div.card-body").html(res);
                toastr.success("FAQ is removed successfully!", "Status");
            });
        }
    }

    function editItem( faqId ) {

        const editedQuestion = $(`#${faqId}_question`).text().trim();
        const eidtedAnswer   = $(`#${faqId}_answer`).text().trim();

        $("#question").val(editedQuestion);
        $("#answer").val(eidtedAnswer);
        $("#editId").val(faqId);

        $("#myModal").modal();
    }

    $(document).on("click" , "a.add-btn" , function() {
        clearFrm();
    });

</script>
@endpush
