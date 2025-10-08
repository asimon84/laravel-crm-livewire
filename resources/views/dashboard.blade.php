<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 dashboard-chart-container">
            <div id="record-chart"></div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table id="myDataTable" class="table table-bordered stripe hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>String</th>
                    <th>Text</th>
                    <th>JSON</th>
                    <th>Boolean</th>
                    <th>Integer</th>
                    <th>Float</th>
                    <th width="100px">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="recordModalLabel">Record Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="record-modal">
                        <tbody>
                        <tr>
                            <td class="bold">ID:</td>
                            <td>
                                <input type="text" id="record-modal-id" name="record-modal-id" disabled value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">String:</td>
                            <td>
                                <input type="text" id="record-modal-string" name="record-modal-string" disabled value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Text:</td>
                            <td>
                                <textarea type="text" id="record-modal-text" name="record-modal-text" disabled>
                                    &nbsp;
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">JSON:</td>
                            <td>
                                <input type="text" id="record-modal-json" name="record-modal-json" disabled value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Boolean:</td>
                            <td>
                                <input type="text" id="record-modal-boolean" name="record-modal-boolean" disabled  value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Integer:</td>
                            <td>
                                <input type="text" id="record-modal-integer" name="record-modal-integer" disabled value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="bold">Float:</td>
                            <td>
                                <input type="text" id="record-modal-float" name="record-modal-float" disabled value=""/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @csrf

    <script>
        window.chartData = @json($chartData);
        window.route = "{{ route('chart-records') }}";

        {!! Vite::content('resources/js/dashboard.js') !!}
    </script>
</x-layouts.app>
