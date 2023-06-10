    <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom pt-5 mt-3 text-center">
            <img class="scpiLogo" src="/assets/frontend/scpi.webp">
            <p class="portal pt-4">MANPOWER POOLING <BR> PORTAL</p>
        </div>
        <div class="list-group list-group-flush recruiterLink">
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterDashboardRoutes"><i class="fa-solid fa-chart-line pe-3"></i> Dashboard</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterOperationRoutes"><i class="fa-solid fa-ship pe-3"></i> Upcoming Operation</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterFormedGroupRoutes"><i class="fa-regular fa-calendar pe-3"></i> Formed Group</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterCompletedRoutes"><i class="fa-solid fa-circle-check pe-3"></i> Completed Operation</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterOnCallWorkerRoutes"><i class="fa-solid fa-user pe-3"></i>  Project Workers</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterDetailsRoutes"><i class="fa-solid fa-user-pen pe-3"></i> Manage Account</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3 border-end" href="/recruiterBackOutArchiveRoutes"> <i class="bi bi-clock-history pe-3"></i> Archived</a>
        </div>
        <div class="sidebar-footing border-top pt-3 text-center">
            <p class="text-center" id="dateDisplay"></p>
            <p class="text-center" id="clockDisplay"></p>

            <button type="button" id="logout" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Logout?">
                <i class="bi bi-box-arrow-left fs-4"></i>
            </button>
        </div>
    </div>
