<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">

<head>
  <th:block th:replace="fragments/import :: info-header" />
  <th:block th:replace="fragments/import :: css-header" />
  <th:block th:replace="fragments/import :: js-header" />
</head>

<body id="page-top">
  <th:block th:replace="fragments/general :: navbar-header" />
  <div id="wrapper">
    <th:block th:replace="fragments/general :: menu" />
    <div id="content-wrapper">
      <div class="container-fluid">
        <th:block th:replace="fragments/general :: panel-page" />
        <div id="divContentHeader" class="card-header">
          <b><span id="titlePage" th:text="${titlePage}"></span></b>
        </div>
        <div class="card-body px-0">
          <div id="alertSuccess" class="alert alert-success" style="display: none;">
            <strong>Success!</strong> <span id="alertSuccessMsg" th:text="${M_0005}"></span>
          </div>
          <div id="alertFailed" class="alert alert-danger" style="display: none;">
            <strong>Failed!</strong> <span id="alertFailedMsg"></span>
          </div>
          <form class="form-inline">
            <div class="form-group">
              <label>Voucher ID :</label>
              <input type="text" class="form-control  mx-4" style="width: 22rem;" id="voucherId" placeholder="">
              <button class="btn btn-primary px-4 shadow-sm" type="submit" id="btnSearch">Search</button>
              <button class="btn btn-primary d-none px-4 shadow-sm" type="button" id="btnloadingSearch" disabled>
                <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>
                Loading...
              </button>
            </div>
          </form>
          <form action="" class="py-5">
            <div class="form-inline mb-4">
              <div class="form-group">
                <label for="participant" class="font-weight-bold">Participant</label>
                <span class="ml-4 mr-1">:</span>
                <input style="width: 18rem;" type="text" id="participant" class="form-control-plaintext  mr-3 px-2" disabled value="-">
              </div>
              <div class="form-group">
                <label for="policyno" class="font-weight-bold">Policy No</label>
                <span class="ml-3 mr-1">:</span>
                <input style="width: 18rem;" type="text" id="policyNo" class="form-control-plaintext  px-2" disabled value="-">
              </div>
              <div class="form-group">
                <label for="typeOfCover" class="font-weight-bold">Cover</label>
                <span class="ml-3 mr-1">:</span>
                <input type="text" style="width: 10rem;" id="typeOfCover" class="form-control-plaintext  px-2" disabled value="-">
              </div>
            </div>
            <div class="form-inline mb-4">
              <div class="form-group">
                <label for="invoice" class="ml-1 font-weight-bold">Invoice</label>
                <span class="ml-5 mr-1">:</span>
                <input style="width: 18rem;" type="text" id="invoice" class="form-control-plaintext  mr-3 px-2" disabled value="-">
              </div>
              <div class="form-group">
                <label for="periode" class="mr-1 font-weight-bold">Periode</label>
                <span class="ml-4 mr-1">:</span>
                <input style="width: 18rem;" type="text" id="periode" class="form-control-plaintext px-2" value="DD/MM/YYYY - DD/MM/YYYY" disabled>
              </div>
              <div class="form-group">
                <label for="rqid" class="font-weight-bold">RQ ID</label>
                <span class="ml-3 mr-1">:</span>
                <input type="text" style="width: 10rem;" id="rqId" disabled class="form-control-plaintext  px-2" value="-">
              </div>
            </div>
            <div class="form-inline mb-5">
              <div class="form-group">
                <label for="jurnaldate" class="font-weight-bold">Jurnal Date</label>
                <span class="ml-4 mr-1">:</span>
                <input type="text" id="jurnaldate" value="DD/MM/YYYY'" disabled style="width: 10rem;" class="form-control-plaintext  px-2">
              </div>
            </div>
            <div class="form-inline">
              <div class="form-group">
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input disabled type="checkbox" class="custom-control-input" id="checkboxUpdateStatus">
                  <label class="custom-control-label" for="checkboxUpdateStatus">
                    Update Status 'Inactive' (Manual Jurnal)</label>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input disabled type="checkbox" class="custom-control-input" id="checkboxJournalDate">
                  <label class="custom-control-label" for="checkboxJournalDate">
                    Jurnal Date</label>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input id="TextBoxjurnaldate" name="TextBoxjurnaldate" type="text" class="form-control" disabled>
                  <div class="input-group-append">
                    <button id='btnTextBoxjurnaldate' class="btn btn-primary" type="button" disabled>
                      <i class="fas fa-calendar"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox ml-2 mr-sm-2">
                  <input disabled type="checkbox" class="custom-control-input" id="checkboxPolicyNo">
                  <label class="custom-control-label" for="checkboxPolicyNo">
                    Policy No</label>
                </div>
              </div>
              <div class="form-group">
                <input type="text" style="width: 10rem;" id="remarks" disabled class="form-control  mr-sm-2 px-2">
              </div>
              <button class="btn btn-success px-4 shadow-sm" disabled type="submit" id="btnUpdate">Update</button>
              <button class="btn btn-success d-none px-4 shadow-sm" type="button" id="btnloadingUpdate" disabled>
                <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>
                Loading...
              </button>
            </div>
          </form>
        </div>
        <th:block th:replace="fragments/modal :: confirmation-save" />
        <th:block th:replace="fragments/general :: copyright-footer"></th:block>
      </div>
    </div>
  </div>
  <th:block th:replace="fragments/general :: scroll-to-top" />
  <th:block th:replace="fragments/general :: logout-modal" />
  <th:block th:replace="fragments/import :: js-body" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script type="text/javascript">
    $(document).ready(function() {
      $('#btnSearch').click(function(e) {
        e.preventDefault();
        var voucherId = $('#voucherId').val();
        $('#btnSearch').addClass('d-none');
        $('#btnloadingSearch').removeClass('d-none');
        $.ajax({
          type: "GET",
          url: "/gui-re-broker/static-data/update-status/inquiry",
          data: {
            "voucherId": voucherId
          },
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data) {
            if (data.countVoucherId !== 0) {
              $('#btnSearch').removeClass('d-none');
              $('#btnloadingSearch').addClass('d-none');
              $('#btnUpdate').removeAttr('disabled');

              $('#checkboxJournalDate').prop('checked', data.checkboxJournalDate);
              $('#checkboxJournalDate').removeAttr('disabled');

              $('#checkboxPolicyNo').prop('checked', data.checkboxPolicyNo);
              $('#checkboxPolicyNo').removeAttr('disabled');

              $('#checkboxUpdateStatus').prop('checked', data.checkboxUpdateStatus);
              $('#checkboxUpdateStatus').removeAttr('disabled');

              $('#invoice').val(data.invoice);
              $('#participant').val(data.participant);
              $('#policyNo').val(data.policyNo);
              $('#rqId').val(data.rqId);
              $('#typeOfCover').val(data.typeOfCover);

              var journalDate = new Date(data.journalDate);
              $('#jurnaldate').val(journalDate.toLocaleDateString());

              var $datepicker = $('#TextBoxjurnaldate');
              $('#TextBoxjurnaldate').removeAttr('disabled');

              $datepicker.datepicker();
              $datepicker.datepicker('setDate', new Date());
              $('#btnTextBoxjurnaldate').click(function() {
                $datepicker.datepicker('show');
              });
              $('#btnTextBoxjurnaldate').removeAttr('disabled');

              let endPeriod = new Date(data.endPeriod);
              let startPeriod = new Date(data.startPeriod);
              $('#periode').daterangepicker({
                startDate: startPeriod,
                endDate: endPeriod,
                opens: 'left'
              }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
              });
              $('#remarks').removeAttr('disabled');
            } else {
              $('#btnSearch').removeClass('d-none');
              $('#btnloadingSearch').addClass('d-none');
              alert('No Matching records found');
            }
          },
          error: function(errMsg) {
            alert(errMsg);
          }
        });
      });
      $('#btnUpdate').click(function(e) {
        e.preventDefault();
        $('#btnUpdate').addClass('d-none');
        $('#btnloadingUpdate').removeClass('d-none');

        var voucherId = $('#voucherId').val();
        var checkboxJournalDate;
        if ($('#checkboxJournalDate').prop('checked')) {
          checkboxJournalDate = 1
        } else {
          checkboxJournalDate = 0
        }
        var checkboxPolicyNo;
        if ($('#checkboxPolicyNo').prop('checked')) {
          checkboxPolicyNo = 1
        } else {
          checkboxPolicyNo = 0
        }
        var checkboxUpdateStatus;
        if ($('#checkboxUpdateStatus').prop('checked')) {
          checkboxUpdateStatus = 1
        } else {
          checkboxUpdateStatus = 0
        }
        var invoice = $('#invoice').val();
        var participant = $('#participant').val();
        var policyNo = $('#policyNo').val();
        var rqId = $('#rqId').val();
        var typeOfCover = $('#typeOfCover').val();
        var remarks = $('#remarks').val();
        var jsDate = $('#TextBoxjurnaldate').datepicker('getDate');
        jsDate instanceof Date;
        var month = jsDate.getMonth();
        var day = jsDate.getDate()
        var year = jsDate.getFullYear();
        var settings = {
          "url": "http://localhost:8080/gui-re-broker/static-data/update-status/inquiry-date?" + "month=" + (month + 1) + "&year=" + year,
          "method": "GET",
          "timeout": 0,
        };
        $.ajax(settings).done(function(response) {
          var date = jsDate.getFullYear() + "-" + (month + 1) + "-" + (day + 1);
          console.log(response);
          if (!response) {
            $('#modalConfirmation').modal('show');
            $('#btnUpdate').removeClass('d-none');
            $('#btnloadingUpdate').addClass('d-none');
            $('#btnModalYes').click(function(e) {
              $('#modalConfirmation').modal('hide');
              $('#btnUpdate').addClass('d-none');
              $('#btnloadingUpdate').removeClass('d-none');
              e.preventDefault();
              $.ajax({
                type: "POST",
                url: "http://localhost:8080/gui-re-broker/static-data/update-status/save",
                data: JSON.stringify({
                  "voucherId": voucherId,
                  "checkboxUpdateStatus": checkboxUpdateStatus,
                  "checkboxJournalDate": checkboxJournalDate,
                  "checkboxPolicyNo": checkboxPolicyNo,
                  "rqId": rqId,
                  "remarks": remarks,
                  "date": date,
                  "month": month + 1,
                  "year": year
                }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                  $('#btnUpdate').removeClass('d-none');
                  $('#btnloadingUpdate').addClass('d-none');
                  reset()
                  if (data.status == "200") {
                    showAlertSuccess();
                  } else {
                    showAlertFailed(data.message);
                  }
                },
                error: function(errMsg) {
                  alert(errMsg);
                }
              });
            });

          } else {
            $('#btnUpdate').removeClass('d-none');
            $('#btnloadingUpdate').addClass('d-none');
            alert(response)
          }
        });
      });

      function reset() {
        $('#voucherId').val('');
        $('#policyNo').val('-');
        $('#typeOfCover').val('-');
        $('#rqId').val('-');
        $('#jurnaldate').val('DD/MM/YYYY');
        $('#invoice').val('-');
        $('#periode').val('DD/MM/YYYY - DD/MM/YYYY');
        $('#remarks').val('');
        $('#remarks').attr('disabled', 'true');
        $('#TextBoxjurnaldate').val('');
        $('#TextBoxjurnaldate').attr('disabled', 'true');
        $('#btnTextBoxjurnaldate').attr('disabled', 'true');

        $('#checkboxJournalDate').prop('checked', false);
        $('#checkboxJournalDate').attr('disabled', 'true');

        $('#checkboxPolicyNo').attr('disabled', 'true');
        $('#checkboxPolicyNo').prop('checked', false);

        $('#checkboxUpdateStatus').attr('disabled', 'true');
        $('#checkboxUpdateStatus').prop('checked', false);
      }

      function showAlertSuccess() {

        $('#alertSuccess').fadeTo(2000, 500).slideUp(500, function() {
          $('#alertSuccess').slideUp(500);
        });
      }

      function showAlertFailed(msgAlert) {
        $('#alertFailedMsg').text(msgAlert);
        $('#alertFailed').fadeTo(3000, 500).slideUp(500, function() {
          $('#alertFailed').slideUp(500);
          $('btnModalYesDelete').removeAttr('disabled')
          $('#btnModalYes').removeAttr('disabled')
        });
      }
    });
  </script>
</body>

</html>y