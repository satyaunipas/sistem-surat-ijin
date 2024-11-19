
              <ul class="nav-main">
                  <li class="nav-main-item">
                      <a
                          class="nav-main-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                          href="/admin/dashboard"
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
                          class="nav-main-link {{ Request::is('admin/data-dosen*') ? 'active' : '' }}"
                          href="/admin/data-dosen"
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
                        class="nav-main-link {{ Request::is('admin/data-mahasiswa*') ? 'active' : '' }}"
                        href="/admin/data-mahasiswa"
                    >
                        <i
                            class="nav-main-link-icon fa fa-users"
                        ></i>
                        <span class="nav-main-link-name"
                            >Mahasiswa</span
                        >
                    </a>
                </li>
                {{-- <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('admin/data-jurusan*') ? 'active' : '' }}"
                        href="/admin/data-jurusan"
                    >
                        <i
                            class="nav-main-link-icon fa fa-house"
                        ></i>
                        <span class="nav-main-link-name"
                            >Jurusan</span
                        >
                    </a>
                </li> --}}
                <li class="nav-main-item">
                    <a
                        class="nav-main-link {{ Request::is('admin/data-prodi*') ? 'active' : '' }}"
                        href="/admin/data-prodi"
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
                        class="nav-main-link {{ Request::is('admin/data-surat*') ? 'active' : '' }}"
                        href="/admin/data-surat"
                    >
                        <i
                            class="nav-main-link-icon si si-envelope-letter"
                        ></i>
                        <span class="nav-main-link-name"
                            >Surat Ijin</span
                        >
                    </a>
                </li>
              </ul>
          