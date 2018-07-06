
  <div class="card my-4">
      <h5 class="card-header">Search</h5>
      <div class="card-body">

      <form action="{{ route('search') }}" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" name="naslov" placeholder="Pretrazi odobrene oglase...">
          <span class="input-group-btn">
            <input type="submit" class="btn btn-secondary" value="Go">
          </span>
        </div>
       </form>

      </div>
    </div>
 