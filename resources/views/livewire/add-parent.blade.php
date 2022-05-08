<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif


        @if($show_table)
            @include('livewire.Parent_Table')
        @else

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                   class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ trans('Parent_trans.Step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                   class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ trans('Parent_trans.Step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                   class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                   disabled="disabled">3</a>
                <p>{{ trans('Parent_trans.Step3') }}</p>
            </div>
        </div>
    </div>


    @include('livewire.Father_Form')

    @include('livewire.Mother_Form')


    <div class="{{ $currentStep != 3 ? 'displayNone' : '' }}" style="text-align: center!important;margin-top: 20px" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <input type="hidden" wire:model="Parent_id">
                        <h3 style="font-family:'Cairo', sans-serif">{{trans('Parent_trans.information-confirm')}}</h3><br>
                        <button class="btn btn-danger" type="button"
                                wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>

                        @if($updateMode)
                            <button class="btn btn-success" wire:click="submitForm_edit"
                                    type="button">{{ trans('Parent_trans.Finish') }}</button>

                        @else


                        <button class="btn btn-success" wire:click="submitForm"
                                type="button">{{ trans('Parent_trans.Finish') }}</button>

                            @endif
                    </div>
                </div>
            </div>
    </div>
            @endif
</div>
