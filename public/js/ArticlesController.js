
"use strict";

import  Controller from "./Controller.js"

class AuthorsController extends Controller
{
    constructor(route) {
        super(route);
    }
}

const controller = new AuthorsController('/Dashboard/Manage/Articles/Delete')

controller.delete(".delete > a", 'post')