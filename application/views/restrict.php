        <section style="min-height: calc(100vh - 83px)" class="light-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-3 col-lg-6 text-center">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="section-title">
                                    <h2>Área Restrita</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-offset-5 col-lg-2 text-center">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="form-group">
                                    <a class="btn btn-link" user_id="<?=$user_id?>" id="btn_your_user">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <a href="<?php echo base_url('restrict/logoff') ?>" class="btn btn-link">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_courses" role="tab" data-toggle="tab">
                            Cursos
                        </a>
                    </li>
                    <li>
                        <a href="#tab_team" role="tab" data-toggle="tab">
                            Equipe
                        </a>
                    </li>
                    <li>
                        <a href="#tab_user" role="tab" data-toggle="tab">
                            Usuários
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab_courses" class="tab-pane active">
                        <div class="container-fluid">
                            <h2 class="text-center">
                                <strong>
                                    Gerenciar Cursos
                                </strong>
                            </h2>
                            <a id="btn_add_course" class="btn btn-primary" style="margin-bottom: .99em;">
                                <i class="fa fa-plus"></i>
                                &nbsp;&nbsp;Adicionar
                            </a>
                            <table id="dt_courses" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Imagem</th>
                                        <th>Duração</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tab_team" class="tab-pane">
                        <div class="container-fluid">
                            <h2 class="text-center">
                                <strong>
                                    Gerenciar Equipe
                                </strong>
                            </h2>
                            <a id="btn_add_member" class="btn btn-primary" style="margin-bottom: .99em;">
                                <i class="fa fa-plus"></i>
                                &nbsp;&nbsp;Adicionar
                            </a>
                            <table id="dt_team" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tab_user" class="tab-pane">
                        <div class="container-fluid">
                            <h2 class="text-center">
                                <strong>
                                    Gerenciar Usuários
                                </strong>
                            </h2>
                            <a id="btn_add_user" class="btn btn-primary" style="margin-bottom: .99em;">
                                <i class="fa fa-plus"></i>
                                &nbsp;&nbsp;Adicionar
                            </a>
                            <table id="dt_users" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Login</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="modal_course" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <h4 class="modal-title">Cursos</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_course" method="post">
                            <input id="course_id" name="course_id" hidden>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="course_name">Nome</label>
                                <div class="col-lg-10">
                                    <input name="course_name" id="course_name" class="form-control" required maxlength="100">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="course_img">Imagem</label>
                                <div class="col-lg-10">
                                    <img id="course_img_path" src="" style="max-width: 400px; max-height: 400px;" alt="course_img">
                                    <label class="btn btn-block btn-info">
                                        <i class="fa fa-upload"></i>
                                        &nbsp;&nbsp;Importar Imagem
                                        <input type="file" id="btn_upload_course_image" accept="image/*" style="display: none">
                                    </label>
                                    <input id="course_img" name="course_img">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="course_duration">Duração (h)</label>
                                <div class="col-lg-10">
                                    <input name="course_duration" id="course_duration" class="form-control" type="number" step="0.1">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="course_description">Descrição</label>
                                <div class="col-lg-10">
                                    <textarea name="course_description" id="course_description" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" id="btn_save_course" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    &nbsp;&nbsp;Salvar
                                </button>
                                <span class="help-block"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal_member" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <h4 class="modal-title">Membro</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_member" method="post">
                            <input id="member_id" name="member_id" hidden>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="member_name">Nome</label>
                                <div class="col-lg-10">
                                    <input name="member_name" id="member_name" class="form-control" required maxlength="100">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="member_img">Foto</label>
                                <div class="col-lg-10">
                                    <img id="member_img_path" src="" style="max-width: 400px; max-height: 400px;" alt="member_img">
                                    <label class="btn btn-block btn-info">
                                        <i class="fa fa-upload"></i>
                                        &nbsp;&nbsp;Importar Imagem
                                        <input type="file" id="btn_upload_member_image" accept="image/*" style="display: none">
                                    </label>
                                    <input id="member_img" name="member_img">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="member_description">Descrição</label>
                                <div class="col-lg-10">
                                    <textarea name="member_description" id="member_description" class="form-control"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" id="btn_save_member" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    &nbsp;&nbsp;Salvar
                                </button>
                                <span class="help-block"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal_user" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <h4 class="modal-title">Usuário</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_user" method="post">
                            <input id="user_id" name="user_id" hidden>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="user_login">Login</label>
                                <div class="col-lg-10">
                                    <input name="user_login" id="user_login" class="form-control" required maxlength="30">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="user_full_name">Nome</label>
                                <div class="col-lg-10">
                                    <input name="user_full_name" id="user_full_name" class="form-control" required maxlength="100">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="user_email">E-mail</label>
                                <div class="col-lg-10">
                                    <input name="user_email" id="user_email" class="form-control" required maxlength="100">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="user_email_confirm">Confirmar E-mail</label>
                                <div class="col-lg-10">
                                    <input name="user_email_confirm" id="user_email_confirm" class="form-control" required maxlength="100">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="user_password">Senha</label>
                                <div class="col-lg-10">
                                    <input name="user_password" type="password" id="user_password" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="user_password_confirm">Confirmar Senha</label>
                                <div class="col-lg-10">
                                    <input name="user_password_confirm" type="password" id="user_password_confirm" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" id="btn_save_user" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    &nbsp;&nbsp;Salvar
                                </button>
                                <span class="help-block"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>