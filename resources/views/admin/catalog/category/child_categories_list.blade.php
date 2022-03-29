<tr>
    <td>{{$childCategory->id}}</td>
    <td>{!! $delimiter ?? ""!!} {{$childCategory->name}}</td>
    <td>
        @if ($childCategory->active === 0)
            <span class="pale-icon"><i class="far fa-check-circle"></i></span>
        @endif
        @if ($childCategory->active === 1)
            <span class="green-icon"><i class="far fa-check-circle"></i></span>
        @endif
    </td>
    <td>
        @if ($childCategory->main === 0)
            <span class="pale-icon"><i class="far fa-check-circle"></i></span>
        @endif
        @if ($childCategory->main === 1)
            <span class="green-icon"><i class="far fa-check-circle"></i></span>
        @endif
    </td>
    <td>{{$childCategory->sort}}</td>
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
        @include('admin.catalog.category.child_categories_list', ['childCategory' => $childCategory, 'delimiter' => '&nbsp;–&nbsp;' . $delimiter])
    @endforeach
@endif
