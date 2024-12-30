<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Doctor</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
	<div class="container mt-5">
		<h1 class="mb-4">Edit Doctor</h1>

		<!-- Edit Doctor Form -->
		<div class="card mb-4">
			<div class="card-header">Edit Doctor</div>
			<div class="card-body">
				<form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" name="name" id="name" class="form-control" value="{{ $doctor->name }}" required>
					</div>
					<div class="mb-3">
						<label for="specialty" class="form-label">Specialty</label>
						<input type="text" name="specialty" id="specialty" class="form-control" value="{{ $doctor->specialty }}">
					</div>
					<div class="mb-3">
						<label for="phone_number" class="form-label">Contact</label>
						<input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $doctor->phone_number }}" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" id="email" class="form-control" value="{{ $doctor->email }}" required>
					</div>
					<div class="mb-3">
						<label for="image" class="form-label">Image</label>
						<input type="file" name="image" id="image" class="form-control">
						@if($doctor->image)
						<img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" width="50" class="mt-2">
						@endif
					</div>

					<button type="submit" class="btn btn-primary">Update Doctor</button>
				</form>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>