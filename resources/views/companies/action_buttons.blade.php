<a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit</a>
<button type="button" class="btn btn-danger btn-delete" data-url="{{ route('companies.destroy', $company->id) }}">Delete</button>