@extends('admin.layouts.master')
@section('content')
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title"> Locations List</h4>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#locationModal">
                Add Location
              </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table tablesorter" id="locations_list">
                <thead class=" text-primary">
                  <tr>
                    <th>S.No</th>
                    <th>Location Name</th>
                    <th>Slam Label</th>
                    <th>Status</th>
                    <th>Action</th>
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

  <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Add Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="locationForm" action="{{ route('admin.locations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="location_name">Location Name</label>
                        <input type="text" class="form-control" id="location_name" name="location_name" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <!-- Move the submit button inside the form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveLocation">Save Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- edit location modal --}}

<div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content card">
          <div class="modal-header">
              <h5 class="modal-title" id="locationModalLabel">Add Location</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="locationForm" action="{{ route('admin.locations.update') }}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="location_name">Location Name</label>
                      <input type="hidden" class="form-control" id="edit_location_id" name="location_id">
                      <input type="text" class="form-control" id="edit_location_name" name="location_name" required>
                  </div>
                  <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" id="edit_status" name="status" required>
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                      </select>
                  </div>
                  <!-- Move the submit button inside the form -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" id="saveLocation">Update Location</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
  @endsection
  
