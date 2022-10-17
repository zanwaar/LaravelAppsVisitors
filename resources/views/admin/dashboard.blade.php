<x-admin-layout>
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


        <div class="row">
          <div class="col-md-1">
            <label>Remark</label>
          </div>
          <div class="col-md-5">
            <textarea class="form-control" id="remark" name="remark" rows="4" disabled></textarea>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <label>Segmentation</label>
              </div>
              <div class="col-md-8">
                <select id="segmentation" name="segmentation" class="custom-select" disabled>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label>Grupe</label>
              </div>
              <div class="col-md-8">
                <select id="grup" name="grup" class="custom-select" disabled>
                </select>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
    <!-- /.content -->
  </div>


  <script>
    // const myJSON = '{"name":"John", "age":30, "car":null}';
    const myJSON = {
      "attributes": {
        "site_email": null,
        "site_name": "VISITORS",
        "site_title": "PLTD SELAYAR",
        "footer_text": null,
        "sidebar_collapse": false
      },
      "old": {
        "site_email": null,
        "site_name": "VISITORS",
        "site_title": "PLTD SELAYARe",
        "footer_text": null,
        "sidebar_collapse": false
      }
    };


    var result = Object.keys(myJSON.attributes).map((key) => [Number(key), myJSON.attributesj[key]]);

    console.log(result);
  </script>
</x-admin-layout>