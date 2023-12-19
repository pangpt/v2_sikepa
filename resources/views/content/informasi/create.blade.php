@extends('layouts/contentNavbarLayout')

@section('title', ' Horizontal Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Buat Informasi</h4>

<!-- Basic Layout & Basic with Icons -->

<div class="row">
  <div class="col-12">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Buat Informasi Baru</h5>
            </div>
            <div class="card-body">
              <form action="{{route('informasi-baru-create')}}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">Judul Informasi</label>
                  <div class="col-sm-10">
                    <input type="text" id="judul" name="judul" class="form-control" placeholder="" />
                  </div>
                </div>
                {{-- <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">Tanggal</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="date" name="tanggal" placeholder="Mulai" id="tanggal" />
                  </div>
                </div> --}}
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Isi Informasi</label>
                  <div class="col-sm-10">
                    <textarea id="elm1" name="isi_konten" rows="10"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-phone">Lampiran</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="file_path" name="file_path">
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>
  </div>
</div>
@endsection

@section('js-after')
<script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "silver",
                        height:500,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ],
                        images_upload_handler: function (blobInfo, success, failure) {
                                var xhr, formData;
                                xhr = new XMLHttpRequest();
                                xhr.withCredentials = false;
                                xhr.open('POST', '/admin/blog/uploadfile');
                                var token = '{{ csrf_token() }}';
                                xhr.setRequestHeader("X-CSRF-Token", token);
                                xhr.onload = function() {
                                    var json;
                                    if (xhr.status != 200) {
                                        failure('HTTP Error: ' + xhr.status);
                                        return;
                                    }
                                    json = JSON.parse(xhr.responseText);

                                    if (!json || typeof json.location != 'string') {
                                        failure('Invalid JSON: ' + xhr.responseText);
                                        return;
                                    }
                                    success(json.location);
                                };
                                formData = new FormData();
                                formData.append('file', blobInfo.blob(), blobInfo.filename());
                                xhr.send(formData);
                            }
                        /* we override default upload handler to simulate successful upload*/
                        // images_upload_handler: function (blobInfo, success, failure) {
                        //     setTimeout(function () {
                        //     /* no matter what you upload, we will turn it into TinyMCE logo :)*/
                        //     success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
                        //     }, 2000);
                        // }
                    });
                }
                app.init();
                // appmanagement.handleManagementPage($('#filter').val());
                jQuery('#effective_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#effective_until').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                $('.select2').select2();
                $('#resetfoto').on('click',function(){
                    $('#fotoimage').attr('src', '{{ asset('images/default.png') }}');
                    $('#valueresetfoto').val('1');
                    $('#foto').val('');
                });
            })
            $(function () {
                $("#foto").change(function () {
                    var size = this.files[0].size;
                    if(size > 15000000){
                        $(this).addClass('is-invalid');
                        $('#submitbutton').attr('disabled', true);
                    }else{
                        $(this).removeClass('is-invalid');
                        $('#submitbutton').attr('disabled', false);
                    }
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });

            function imageIsLoaded(e) {
                $('#fotoimage').attr('src', e.target.result);
                $('#valueresetfoto').val('');
            };
        </script>
@endsection
