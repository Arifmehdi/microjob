<tr>
    <td>
        @if($category->parent)
            <span class="pl-2">{{ __('-') }}</span>
        @endif
        <span>{{ $category->name ?? '' }}</span>
    </td>
    <td>{{ $category->min_cost_per_work ? balanceFormat($category->min_cost_per_work) : balanceFormat() }}</td>
    <td>
        @if($category->status)
            <span class="badge badge-success">Enabled</span>
        @else
            <span class="badge badge-danger">Disabled</span>
        @endif
    </td>
    <td>{{ $category->created_at ? $category->created_at->format('d-m-Y h:i a') : '' }}</td>
    <td>
        <a href="{{ route('admin.categories.edit',$category->id) }}"
           class="text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-edit table-sm">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
        </a>
        @if($category->is_deletable)
            <button class="text-danger border-0 bg-transparent"
                    onclick="event.preventDefault(); deleteData({{ $category->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </button>
            <form action="{{ route('admin.categories.destroy',$category->id) }}"
                  id="delete-data-{{ $category->id }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </td>
</tr>
