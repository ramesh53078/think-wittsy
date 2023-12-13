@extends('admin.layouts.master')
@section('content')
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title"> Primary List</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table tablesorter" id="feedback_list">
                <thead class=" text-primary">
                  <tr>
                    <th>S.No</th>
                    <th>Sended By</th>
                    <th>Email</th>
                    <th>Feedback</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
