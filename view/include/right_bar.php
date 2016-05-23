<div id="quickview-sidebar">
    <div class="quickview-header">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#chat" data-toggle="tab">Chat</a></li>
            <!--<li><a href="#notes" data-toggle="tab">Notes</a></li>
            <li><a href="#settings" data-toggle="tab" class="settings-tab">Settings</a></li>-->
        </ul>
    </div>
    <div class="quickview">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="chat">
                <div class="chat-body current">
                    <div class="chat-list">
                        <div class="title">Collaborateur</div>
                        <ul>
                            <?php
                            $sql_user_c = $DB->query("SELECT * FROM users WHERE groupe = 1 OR groupe = 2 OR groupe = 3 AND username != :username", array("username" => $user->username));
                            foreach($sql_user_c as $user_c):
                            ?>
                                <li class="clearfix">
                                    <div class="user-img">
                                        <img src="<?= $constante->getUrl(array(), false, true); ?>avatar/<?= $user_c->username; ?>.png" class="img-responsive img-circle" width="35" alt="avatar" />
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name"><?= $user_c->nom_user; ?> <?= $user_c->prenom_user; ?></div>
                                        <div class="user-txt"><?= $user_c->poste_user; ?></div>
                                    </div>
                                    <div class="user-status">
                                        <?php if($user_c->connect == 0): ?>
                                            <i class="busy"></i>
                                        <?php elseif($user_c->connect == 1): ?>
                                            <i class="away"></i>
                                        <?php else: ?>
                                            <i class="online"></i>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="title">Client</div>

                    </div>
                </div>

            </div>
            <!--<div class="tab-pane fade" id="notes">
                <div class="list-notes current withScroll">
                    <div class="notes ">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="add-note">
                                    <i class="fa fa-plus"></i>ADD A NEW NOTE
                                </div>
                            </div>
                        </div>
                        <div id="notes-list">
                            <div class="note-item media current fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Reset my account password</p>
                                    </div>
                                    <p class="note-desc hidden">Break security reasons.</p>
                                    <p><small>Tuesday 6 May, 3:52 pm</small></p>
                                </div>
                            </div>
                            <div class="note-item media fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Call John</p>
                                    </div>
                                    <p class="note-desc hidden">He have my laptop!</p>
                                    <p><small>Thursday 8 May, 2:28 pm</small></p>
                                </div>
                            </div>
                            <div class="note-item media fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Buy a car</p>
                                    </div>
                                    <p class="note-desc hidden">I'm done with the bus</p>
                                    <p><small>Monday 12 May, 3:43 am</small></p>
                                </div>
                            </div>
                            <div class="note-item media fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Don't forget my notes</p>
                                    </div>
                                    <p class="note-desc hidden">I have to read them...</p>
                                    <p><small>Wednesday 5 May, 6:15 pm</small></p>
                                </div>
                            </div>
                            <div class="note-item media current fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Reset my account password</p>
                                    </div>
                                    <p class="note-desc hidden">Break security reasons.</p>
                                    <p><small>Tuesday 6 May, 3:52 pm</small></p>
                                </div>
                            </div>
                            <div class="note-item media fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Call John</p>
                                    </div>
                                    <p class="note-desc hidden">He have my laptop!</p>
                                    <p><small>Thursday 8 May, 2:28 pm</small></p>
                                </div>
                            </div>
                            <div class="note-item media fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Buy a car</p>
                                    </div>
                                    <p class="note-desc hidden">I'm done with the bus</p>
                                    <p><small>Monday 12 May, 3:43 am</small></p>
                                </div>
                            </div>
                            <div class="note-item media fade in">
                                <button class="close">×</button>
                                <div>
                                    <div>
                                        <p class="note-name">Don't forget my notes</p>
                                    </div>
                                    <p class="note-desc hidden">I have to read them...</p>
                                    <p><small>Wednesday 5 May, 6:15 pm</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-note note-hidden-sm">
                    <div class="note-header clearfix">
                        <div class="note-back">
                            <i class="icon-action-undo"></i>
                        </div>
                        <div class="note-edit">Edit Note</div>
                        <div class="note-subtitle">title on first line</div>
                    </div>
                    <div id="note-detail">
                        <div class="note-write">
                            <textarea class="form-control" placeholder="Type your note here"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="settings">
                <div class="settings">
                    <div class="title">ACCOUNT SETTINGS</div>
                    <div class="setting">
                        <span> Show Personal Statut</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input" checked>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
                    </div>
                    <div class="setting">
                        <span> Show my Picture</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input" checked>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
                    </div>
                    <div class="setting">
                        <span> Show my Location</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <p class="setting-info">Lorem ipsum dolor sit amet consectetuer.</p>
                    </div>
                    <div class="title">CHAT</div>
                    <div class="setting">
                        <span> Show User Image</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input" checked>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div class="setting">
                        <span> Show Fullname</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input" checked>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div class="setting">
                        <span> Show Location</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div class="setting">
                        <span> Show Unread Count</span>
                        <label class="switch pull-right">
                            <input type="checkbox" class="switch-input" checked>
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <div class="title">STATISTICS</div>
                    <div class="settings-chart">
                        <div class="clearfix">
                            <div class="chart-title">Stat 1</div>
                            <div class="chart-number">82%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary setting1" data-transitiongoal="82"></div>
                        </div>
                    </div>
                    <div class="settings-chart">
                        <div class="clearfix">
                            <div class="chart-title">Stat 2</div>
                            <div class="chart-number">43%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary setting2" data-transitiongoal="43"></div>
                        </div>
                    </div>
                    <div class="m-t-30" style="width:100%">
                        <canvas id="setting-chart" height="300"></canvas>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>