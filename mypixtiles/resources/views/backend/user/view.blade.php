<div class="modal-body">
					<div class="form-group m-form__group row m--margin-top-20">
						<label class="col-form-label col-lg-3 col-sm-12">Basic Demo</label>
						<div class="col-lg-9 col-md-9 col-sm-12">
							<div class="m-typeahead">
								<input class="form-control m-input" id="m_typeahead_1_modal" dir="ltr" type="text" placeholder="States of USA" value="{{$user->first_name}}">
							</div>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-form-label col-lg-3 col-sm-12">Bloodhound</label>
						<div class="col-lg-9 col-md-9 col-sm-12">
							<div class="m-typeahead">
								<input class="form-control m-input" id="m_typeahead_2_modal" dir="ltr" type="text" placeholder="States of USA" value="{{$user->last_name}}">
							</div>
						</div>
					</div>
					<div class="form-group m-form__group row m--margin-bottom-20">
						<label class="col-form-label col-lg-3 col-sm-12">Prefetch</label>
						<div class="col-lg-9 col-md-9 col-sm-12">
							<div class="m-typeahead">
								<input class="form-control m-input" id="m_typeahead_3_modal" dir="ltr" type="text" placeholder="Countries">
							</div>
							<div class="m-form__help">Prefetched data is fetched and processed on initialization</div>
						</div>
					</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-brand m-btn" data-dismiss="modal">Close</button>
	<button type="button" class="btn btn-secondary m-btn">Submit</button>
</div>
