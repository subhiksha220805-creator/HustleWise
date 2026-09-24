<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="mb-4">Demo Bookings</h2>
        <div class="card shadow-sm mb-5">
            <div class="card-body overflow-auto">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Parent Name</th>
                            <th>Child Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Course</th>
                            <th>Class/Group</th>
                            <th>Pref</th>
                            <th>Date & Time</th>
                            <th>Feedback</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demo_bookings as $booking)
                        <tr>
                            <td>{{ $booking->parent_name }}</td>
                            <td>{{ $booking->children_name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->mobile ?? '-' }}</td>
                            <td>{{ $booking->course }}</td>
                            <td>{{ $booking->class_age_group }}</td>
                            <td>{{ $booking->teacher_preference === '1to1' ? '1 on 1' : $booking->teacher_preference }}</td>
                            <td>{{ ucfirst($booking->date_preference) }} at {{ $booking->time_preference }}</td>
                            <td>{{ $booking->feedback ?? '-' }}</td>
                            <td>
                                <form action="{{ route('demo-bookings.destroy', $booking) }}" method="POST"
                                    onsubmit="return confirm('Delete this demo booking permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h2 class="mb-4">Teacher Applications</h2>
        <div class="card shadow-sm">
            <div class="card-body overflow-auto">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender & Age</th>
                            <th>Qualification</th>
                            <th>Degree</th>
                            <th>Experience</th>
                            <th>Certifications</th>
                            <th>Resume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teacher_applications as $app)
                        <tr>
                            <td>
                                <strong>{{ $app->full_name }}</strong>
                            </td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->phone }}</td>
                            <td>{{ ucfirst($app->gender) }}, {{ $app->age }}</td>
                            <td>{{ $app->qualification }}</td>
                            <td>{{ $app->degree }}</td>
                            <td>{{ Str::limit($app->experience, 50) }}</td>
                            <td>
                                @if($app->certifications)
                                    @foreach(json_decode($app->certifications, true) as $cert)
                                        <span class="badge bg-secondary">{{ $cert }}</span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="/view-resume/{{ $app->id }}" target="_blank" class="btn btn-sm btn-primary">View PDF</a>
                            </td>
                            <td>
                                <form action="{{ route('teacher-applications.destroy', $app) }}" method="POST"
                                    onsubmit="return confirm('Delete this teacher application permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
