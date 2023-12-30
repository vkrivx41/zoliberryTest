"use strict";

import  Controller from "./Controller.js"

class ModeratorsController extends Controller
{
    constructor(route) {
        super(route);
    }
}

const controller = new ModeratorsController('/Dashboard/Delete/Moderator')

controller.delete(".delete > a", 'post')