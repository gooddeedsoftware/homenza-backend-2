@extends('layouts.admin')
@section('content')
@can('banner_card_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banner-cards.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bannerCard.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bannerCard.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BannerCard">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bannerCard.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bannerCard.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.bannerCard.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.bannerCard.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.bannerCard.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bannerCards as $key => $bannerCard)
                        <tr data-entry-id="{{ $bannerCard->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bannerCard->id ?? '' }}
                            </td>
                            <td>
                                {{ $bannerCard->title ?? '' }}
                            </td>
                            <td>
                                {{ $bannerCard->description ?? '' }}
                            </td>
                            <td>
                                @if($bannerCard->image)
                                    <a href="{{ $bannerCard->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $bannerCard->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\BannerCard::STATUS_RADIO[$bannerCard->status] ?? '' }}
                            </td>
                            <td>
                                @can('banner_card_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.banner-cards.show', $bannerCard->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('banner_card_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.banner-cards.edit', $bannerCard->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('banner_card_delete')
                                    <form action="{{ route('admin.banner-cards.destroy', $bannerCard->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('banner_card_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banner-cards.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-BannerCard:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection