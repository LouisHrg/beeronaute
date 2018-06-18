@extends('visitstats::layout')

@section('visitortracker_content')
<div class="row">
	<div class="col-md-12">
		<h5>Résumé</h5>

		<table class="visitortracker-table table table-sm table-striped fs-1">
			<thead>
				<th>Période</th>
				<th>Visiteurs unique</th>
				<th>Visistes</th>
			</thead>

			<tbody>
                <tr>
                    <td>24 heures</td>

                    <td>{{ $unique24h }}</td>

                    <td>{{ $visits24h }}</td>
                </tr>

                <tr>
                    <td>1 semaine</td>

                    <td>{{ $unique1w }}</td>

                    <td>{{ $visits1w }}</td>
                </tr>

                <tr>
                    <td>1 mois</td>

                    <td>{{ $unique1m }}</td>

                    <td>{{ $visits1m }}</td>
                </tr>

                <tr>
                    <td>1 an</td>

                    <td>{{ $unique1y }}</td>

                    <td>{{ $visits1y }}</td>
                </tr>

                <tr>
                    <td>Depuis toujours</td>

                    <td>{{ $uniqueTotal }}</td>

                    <td>{{ $visitsTotal }}</td>
                </tr>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h5>10 dernière requêtes</h5>

		@include('visitstats::_table_requests', ['visits' => $lastVisits])
	</div>
</div>
@endsection