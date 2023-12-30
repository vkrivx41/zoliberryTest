
"use strict";

import  Controller from "./Controller.js"

class MessagesController extends Controller
{
    constructor(route) {
        super(route);
    }
}

const controller = new MessagesController('/Dashboard/Messages')

controller.delete(".delete > a", 'post', false)
