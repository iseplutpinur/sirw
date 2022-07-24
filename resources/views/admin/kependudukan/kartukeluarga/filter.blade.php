<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default active mb-2">
        <div class="panel-heading " role="tab" id="headingOne1">
            <h4 class="panel-title">
                <a role="button" data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse1"
                    aria-expanded="true" aria-controls="collapse1">
                    Filter Data
                </a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne1">
            <div class="panel-body">
                <form action="javascript:void(0)" class="ml-md-3 mb-md-3" id="FilterForm">
                    <div class="form-group float-start me-2">
                        <label for="filter_rt">Rt</label>
                        <select class="form-control" id="filter_rt" name="filter_rt" style="max-width: 200px">
                            <option value="">Semua Rt</option>
                            @foreach ($rts ?? [] as $v)
                                <option value="{{ $v->id }}" class="text-capitalize">
                                    {{ $v->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div style="clear: both"></div>
                <button type="submit" form="FilterForm" class="btn btn-rounded btn-md btn-info" data-toggle="tooltip"
                    title="Refresh Filter Table">
                    <i class="bi bi-arrow-repeat"></i> Terapkan filter
                </button>
            </div>
        </div>
    </div>
</div>
<hr>
