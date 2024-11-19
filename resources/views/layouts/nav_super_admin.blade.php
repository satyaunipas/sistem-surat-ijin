
              <ul class="nav-main">
                  <li class="nav-main-item">
                      <a
                          class="nav-main-link {{ Request::is('super_admin/dashboard*') ? 'active' : '' }}"
                          href="/super_admin/dashboard"
                      >
                          <i
                              class="nav-main-link-icon si si-speedometer"
                          ></i>
                          <span class="nav-main-link-name"
                              >Dashboard</span
                          >
                      </a>
                  </li>
                  <li class="nav-main-heading">Heading</li>
                  <li class="nav-main-item">
                      <a
                          class="nav-main-link {{ Request::is('super_admin/data-dosen*') ? 'active' : '' }}"
                          href="/super_admin/data-dosen"
                      >
                          <i
                              class="nav-main-link-icon si si-users"
                          ></i>
                          <span class="nav-main-link-name"
                              >Dosen</span
                          >
                      </a>
                  </li>
                  <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('super_admin/data-mahasiswa*') ? 'active' : '' }}"
                        href="/super_admin/data-mahasiswa"
                    >
                        <i
                            class="nav-main-link-icon fa fa-users"
                        ></i>
                        <span class="nav-main-link-name"
                            >Mahasiswa</span
                        >
                    </a>
                </li>
                <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('super_admin/data-jurusan*') ? 'active' : '' }}"
                        href="/super_admin/data-jurusan"
                    >
                        <i
                            class="nav-main-link-icon fa fa-house"
                        ></i>
                        <span class="nav-main-link-name"
                            >Jurusan</span
                        >
                    </a>
                </li>
                <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('super_admin/data-prodi*') ? 'active' : '' }}"
                        href="/super_admin/data-prodi"
                    >
                        <i
                            class="nav-main-link-icon fa fa-building-user"
                        ></i>
                        <span class="nav-main-link-name"
                            >Program Studi</span
                        >
                    </a>
                </li>
                <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('super_admin/data-surat*') ? 'active' : '' }}"
                        href="/super_admin/data-surat"
                    >
                        <i
                            class="nav-main-link-icon si si-envelope-letter"
                        ></i>
                        <span class="nav-main-link-name"
                            >Surat</span
                        >
                    </a>
                </li>
                <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('super_admin/admin-jurusan*') ? 'active' : '' }}"
                        href="/super_admin/admin-jurusan"
                    >
                        <i
                            class="nav-main-link-icon fa fa-people-roof"
                        ></i>
                        <span class="nav-main-link-name"
                            >Admin Jurusan</span
                        >
                    </a>
                </li>
              </ul>
          