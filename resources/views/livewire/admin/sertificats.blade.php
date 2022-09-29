<div class="card">
    <div class="card-header" style="justify-content: space-between"> <h4> Sertifikatlar</h4>
        <a href="#" wire:click="export('test')"  class="btn btn-warning btn-icon icon-left"><i class="fas fa-file-excel"></i>Yuklab olish</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">O'quv markazlar bo'yicha </div>
                <div class="form-group" wire:ignore>
                    <select class="form-control select2"  id="school_id">
                        <option value="">Markazni tanlang</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->company_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 p-icon p-round">
                <div class="section-title">Status bo'yicha </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="1">
                    <div class="state p-success">
                        <label>O'qiyotganlar</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="0">
                    <div class="state p-success">
                        <label>Bitirib ketganlar</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="2">
                    <div class="state p-success">
                        <label>Chiqib ketganlar</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="section-title">Qidiruv </div>
                <div class="form-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="search...">
                </div>
            </div>
        </div>

        <div class="table-responsive ">
            <table class="table table-bordered table-striped" id="table-1">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>F.I.O</th>
                    <th>O'quv markaz</th>
                    <th>Xudud</th>
                    <th>Yo'nalish</th>
                    <th>Telefon</th>
                    <th>O'qish xolati</th>
                    <th>Sertifikat xolati</th>
                    <th>Sertifikat</th>
                    <th>Sertifikat berish </th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $item)

                    <tr>
                        <td>{{ $item->id  }}</td>
                        <td>{{ $item->name }}</td>
                        <td> {{ $item->getSchool->company_name }} </td>
                        <td> {{ $item->getSchool->district->name ?? '' }} </td>
                        <td> {{ $item->group->course->name }}</td>
                        <td>{{ $item->phone }} </td>
                        <td>@if($item->status==2)
                                <div class="badge badge-danger">Chiqib ketgan</div>
                            @elseif($item->status==1)
                                <div class="badge badge-success"> O'qiyapti </div>
                            @else
                                <div class="badge badge-warning"> Bitirgan </div>
                            @endif
                        </td>
                                               <td>
                                                   @if($item->sertificat_status)
                                                        <div class="badge badge-success"> Berilgan </div>
                                                   @else
                                                       <div class="badge badge-info"> Berilmagan </div>
                                                   @endif
                                               </td>
                                                <td>
                                                    <a class="btn {{ !$item->sertificat_status ? 'disabled' : '' }} btn-warning" href="/admin/sertificats/{{ $item->sertificat_file }}">Yuklab olish</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-info" href="{{ route('admin.sertificatForm', $item->id) }}">Sertifikat berish</a>
                                                </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $students->onEachSide(0)->links() }}
        </div>

    </div>
</div>
@push('js')
    <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('#school_id').change(function (e) {
        @this.set('school_id', $(this).val() );
        });

    </script>
@endpush