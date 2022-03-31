@php $delimiter = isset($delimiter) ? $delimiter : '&nbsp;–&nbsp;' @endphp
<tr>
    <td class="text-center"><i class="far fa-folder"></i></td>
    <td>{!! $delimiter !!}<a href="{{ route('product.list', $childCategory->id) }}" class="mr-3"> {{$childCategory->name}}</a></td>
    <td></td>
    <td>
        @if ($childCategory->active === 0)
            <span class="pale-icon"><i class="far fa-check-circle"></i></span>
        @endif
        @if ($childCategory->active === 1)
            <span class="green-icon"><i class="far fa-check-circle"></i></span>
        @endif
    </td>
    <td>{{$childCategory->sort}}</td>
    <td>{{$childCategory->id}}</td>
    <td>
        <a href="{{ route('category.edit', $childCategory->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
        <form method="POST" action="{{ route('category.destroy', $childCategory->id) }}" class="formDelete">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
@if(count($childCategory->children)>0)
    @foreach ($childCategory->children as $childCategory)
        @include('admin.catalog.product.child_categories_list', ['childCategory' => $childCategory, 'delimiter' => '&nbsp;–&nbsp;' . $delimiter])
    @endforeach
@endif
