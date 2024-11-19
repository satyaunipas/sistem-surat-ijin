
              <ul class="nav-main">
                    @php
                    $dosenDashboardRoute = auth()->user()->status == 1 ? '/dosen/dashboard-2' : '/dosen/dashboard';
                    @endphp
                    
                    <li class="nav-main-item">
                        <a
                            class="nav-main-link {{ Request::is('dosen/dashboard*') || Request::is('dosen/dashboard-2*') ? 'active' : '' }}"
                            href="{{ $dosenDashboardRoute }}"
                        >
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                  <li class="nav-main-heading">Heading</li>
                  <li class="nav-main-item">
                      <a
                          class="nav-main-link {{ Request::is('dosen/*/edit') ? 'active' : '' }}"
                            href="{{ route('dosen.edit', auth()->user()->username) }}"
                      >
                          <i
                              class="nav-main-link-icon si si-user"
                          ></i>
                          <span class="nav-main-link-name"
                              >Profil</span
                          >
                      </a>
                  </li>
              </ul>
          