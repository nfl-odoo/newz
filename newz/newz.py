from openerp import models, fields, api
from openerp.exceptions import ValidationError

class newz_newz(models.Model):
    _name = "newz.newz"
    # name = fields.Char(string="Name")
    _rec_name = "title"

    url = fields.Char(string="URL")
    title = fields.Char(string="Title")
    content = fields.Text(string="Content")
    author = fields.Char(string="Author")
    source = fields.Char(string="Source")
    newz_date = fields.Date(string="Newz Date")
    cat_ids = fields.Many2many("newz.cat", string="Categories")
    read_user_ids = fields.Many2many("res.users", relation="rel_newz_user", string="Readers")

    @api.one
    @api.constrains("url")
    def _uniq_ulr(self):
        if self.search_count([("url", "=", self.url)]) > 1:
            raise ValidationError("URL must be unique.")


class newz_cat(models.Model):
    _name = "newz.cat"

    name = fields.Char(required=True, string="Name")
    code = fields.Char(required=True, string="Code")
    color = fields.Char(string="Color")
    img_path = fields.Char(string="Image Path")

    @api.one
    @api.constrains("name")
    def _uniq_name(self):
        if self.search_count([("name", "=", self.name)]) > 1:
            raise ValidationError("Name must be unique.")

    @api.one
    @api.constrains("code")
    def _uniq_code(self):
        if self.search_count([("code", "=", self.code)]) > 1:
            raise ValidationError("Code must be unique.")


class newz_user(models.Model):
    _inherit = "res.users"

    read_newz_ids = fields.Many2many("newz.newz", relation="rel_newz_user", string="Read Newz")




























