/* YUI 3.9.0 (build 5827) Copyright 2013 Yahoo! Inc. http://yuilibrary.com/license/ */
YUI.add("dd-drag",function(e,t){var n=e.DD.DDM,r="node",i="dragging",s="dragNode",o="offsetHeight",u="offsetWidth",a="drag:mouseDown",f="drag:afterMouseDown",l="drag:removeHandle",c="drag:addHandle",h="drag:removeInvalid",p="drag:addInvalid",d="drag:start",v="drag:end",m="drag:drag",g="drag:align",y=function(t){this._lazyAddAttrs=!1,y.superclass.constructor.apply(this,arguments);var r=n._regDrag(this);r||e.error("Failed to register node, already in use: "+t.node)};y.NAME="drag",y.START_EVENT="mousedown",y.ATTRS={node:{setter:function(t){if(this._canDrag(t))return t;var n=e.one(t);return n||e.error("DD.Drag: Invalid Node Given: "+t),n}},dragNode:{setter:function(t){if(this._canDrag(t))return t;var n=e.one(t);return n||e.error("DD.Drag: Invalid dragNode Given: "+t),n}},offsetNode:{value:!0},startCentered:{value:!1},clickPixelThresh:{value:n.get("clickPixelThresh")},clickTimeThresh:{value:n.get("clickTimeThresh")},lock:{value:!1,setter:function(e){return e?this.get(r).addClass(n.CSS_PREFIX+"-locked"):this.get(r).removeClass(n.CSS_PREFIX+"-locked"),e}},data:{value:!1},move:{value:!0},useShim:{value:!0},activeHandle:{value:!1},primaryButtonOnly:{value:!0},dragging:{value:!1},parent:{value:!1},target:{value:!1,setter:function(e){return this._handleTarget(e),e}},dragMode:{value:null,setter:function(e){return n._setDragMode(e)}},groups:{value:["default"],getter:function(){return this._groups?e.Object.keys(this._groups):(this._groups={},[])},setter:function(t){return this._groups=e.Array.hash(t),t}},handles:{value:null,setter:function(t){return t?(this._handles={},e.Array.each(t,function(t){var n=t;if(t instanceof e.Node||t instanceof e.NodeList)n=t._yuid;this._handles[n]=t},this)):this._handles=null,t}},bubbles:{setter:function(e){return this.addTarget(e),e}},haltDown:{value:!0}},e.extend(y,e.Base,{_canDrag:function(e){return e&&e.setXY&&e.getXY&&e.test&&e.contains?!0:!1},_bubbleTargets:e.DD.DDM,addToGroup:function(e){return this._groups[e]=!0,n._activateTargets(),this},removeFromGroup:function(e){return delete this._groups[e],n._activateTargets(),this},target:null,_handleTarget:function(t){e.DD.Drop&&(t===!1?this.target&&(n._unregTarget(this.target),this.target=null):(e.Lang.isObject(t)||(t={}),t.bubbleTargets=t.bubbleTargets||e.Object.values(this._yuievt.targets),t.node=this.get(r),t.groups=t.groups||this.get("groups"),this.target=new e.DD.Drop(t)))},_groups:null,_createEvents:function(){this.publish(a,{defaultFn:this._defMouseDownFn,queuable:!1,emitFacade:!0,bubbles:!0,prefix:"drag"}),this.publish(g,{defaultFn:this._defAlignFn,queuable:!1,emitFacade:!0,bubbles:!0,prefix:"drag"}),this.publish(m,{defaultFn:this._defDragFn,queuable:!1,emitFacade:!0,bubbles:!0,prefix:"drag"}),this.publish(v,{defaultFn:this._defEndFn,preventedFn:this._prevEndFn,queuable:!1,emitFacade:!0,bubbles:!0,prefix:"drag"});var t=[f,l,c,h,p,d,"drag:drophit","drag:dropmiss","drag:over","drag:enter","drag:exit"];e.Array.each(t,function(e){this.publish(e,{type:e,emitFacade:!0,bubbles:!0,preventable:!1,queuable:!1,prefix:"drag"})},this)},_ev_md:null,_startTime:null,_endTime:null,_handles:null,_invalids:null,_invalidsDefault:{textarea:!0,input:!0,a:!0,button:!0,select:!0},_dragThreshMet:null,_fromTimeout:null,_clickTimeout:null,deltaXY:null,startXY:null,nodeXY:null,lastXY:null,actXY:null,realXY:null,mouseXY:null,region:null,_handleMouseUp:function(){this.fire("drag:mouseup"),this._fixIEMouseUp(),n.activeDrag&&n._end()},_fixDragStart:function(e){this.validClick(e)&&e.preventDefault()},_ieSelectFix:function(){return!1},_ieSelectBack:null,_fixIEMouseDown:function(){e.UA.ie&&(this._ieSelectBack=e.config.doc.body.onselectstart,e.config.doc.body.onselectstart=this._ieSelectFix)},_fixIEMouseUp:function(){e.UA.ie&&(e.config.doc.body.onselectstart=this._ieSelectBack)},_handleMouseDownEvent:function(e){this.fire(a,{ev:e})},_defMouseDownFn:function(t){var r=t.ev;this._dragThreshMet=!1,this._ev_md=r;if(this.get("primaryButtonOnly")&&r.button>1)return!1;this.validClick(r)&&(this._fixIEMouseDown(r),y.START_EVENT.indexOf("gesture")!==0&&(this.get("haltDown")?r.halt():r.preventDefault()),this._setStartPosition([r.pageX,r.pageY]),n.activeDrag=this,this._clickTimeout=e.later(this.get("clickTimeThresh"),this,this._timeoutCheck)),this.fire(f,{ev:r})},validClick:function(t){var n=!1,i=!1,s=t.target,o=null,u=null,a=null,f=!1;if(this._handles)e.Object.each(this._handles,function(t,r){t instanceof e.Node||t instanceof e.NodeList?n||(a=t,a instanceof e.Node&&(a=new e.NodeList(t._node)),a.each(function(e){e.contains(s)&&(n=!0)})):e.Lang.isString(r)&&s.test(r+", "+r+" *")&&!o&&(o=r,n=!0)});else{i=this.get(r);if(i.contains(s)||i.compareTo(s))n=!0}return n&&this._invalids&&e.Object.each(this._invalids,function(t,r){e.Lang.isString(r)&&s.test(r+", "+r+" *")&&(n=!1)}),n&&(o?(u=t.currentTarget.all(o),f=!1,u.each(function(e){(e.contains(s)||e.compareTo(s))&&!f&&(f=!0,this.set("activeHandle",e))},this)):this.set("activeHandle",this.get(r))),n},_setStartPosition:function(e){this.startXY=e,this.nodeXY=this.lastXY=this.realXY=this.get(r).getXY(),this.get("offsetNode")?this.deltaXY=[this.startXY[0]-this.nodeXY[0],this.startXY[1]-this.nodeXY[1]]:this.deltaXY=[0,0]},_timeoutCheck:function(){!this.get("lock")&&!this._dragThreshMet&&this._ev_md&&(this._fromTimeout=this._dragThreshMet=!0,this.start(),this._alignNode([this._ev_md.pageX,this._ev_md.pageY],!0))},removeHandle:function(t){var n=t;if(t instanceof e.Node||t instanceof e.NodeList)n=t._yuid;return this._handles[n]&&(delete this._handles[n],this.fire(l,{handle:t})),this},addHandle:function(t){this._handles||(this._handles={});var n=t;if(t instanceof e.Node||t instanceof e.NodeList)n=t._yuid;return this._handles[n]=t,this.fire(c,{handle:t}),this},removeInvalid:function(e){return this._invalids[e]&&(this._invalids[e]=null,delete this._invalids[e],this.fire(h,{handle:e})),this},addInvalid:function(t){return e.Lang.isString(t)&&(this._invalids[t]=!0,this.fire(p,{handle:t})),this},initializer:function(){this.get(r).dd=this
;if(!this.get(r).get("id")){var t=e.stamp(this.get(r));this.get(r).set("id",t)}this.actXY=[],this._invalids=e.clone(this._invalidsDefault,!0),this._createEvents(),this.get(s)||this.set(s,this.get(r)),this.on("initializedChange",e.bind(this._prep,this)),this.set("groups",this.get("groups"))},_prep:function(){this._dragThreshMet=!1;var t=this.get(r);t.addClass(n.CSS_PREFIX+"-draggable"),t.on(y.START_EVENT,e.bind(this._handleMouseDownEvent,this)),t.on("mouseup",e.bind(this._handleMouseUp,this)),t.on("dragstart",e.bind(this._fixDragStart,this))},_unprep:function(){var e=this.get(r);e.removeClass(n.CSS_PREFIX+"-draggable"),e.detachAll("mouseup"),e.detachAll("dragstart"),e.detachAll(y.START_EVENT),this.mouseXY=[],this.deltaXY=[0,0],this.startXY=[],this.nodeXY=[],this.lastXY=[],this.actXY=[],this.realXY=[]},start:function(){if(!this.get("lock")&&!this.get(i)){var e=this.get(r),t,a,f;this._startTime=(new Date).getTime(),n._start(),e.addClass(n.CSS_PREFIX+"-dragging"),this.fire(d,{pageX:this.nodeXY[0],pageY:this.nodeXY[1],startTime:this._startTime}),e=this.get(s),f=this.nodeXY,t=e.get(u),a=e.get(o),this.get("startCentered")&&this._setStartPosition([f[0]+t/2,f[1]+a/2]),this.region={0:f[0],1:f[1],area:0,top:f[1],right:f[0]+t,bottom:f[1]+a,left:f[0]},this.set(i,!0)}return this},end:function(){return this._endTime=(new Date).getTime(),this._clickTimeout&&this._clickTimeout.cancel(),this._dragThreshMet=this._fromTimeout=!1,!this.get("lock")&&this.get(i)&&this.fire(v,{pageX:this.lastXY[0],pageY:this.lastXY[1],startTime:this._startTime,endTime:this._endTime}),this.get(r).removeClass(n.CSS_PREFIX+"-dragging"),this.set(i,!1),this.deltaXY=[0,0],this},_defEndFn:function(){this._fixIEMouseUp(),this._ev_md=null},_prevEndFn:function(){this._fixIEMouseUp(),this.get(s).setXY(this.nodeXY),this._ev_md=null,this.region=null},_align:function(e){this.fire(g,{pageX:e[0],pageY:e[1]})},_defAlignFn:function(e){this.actXY=[e.pageX-this.deltaXY[0],e.pageY-this.deltaXY[1]]},_alignNode:function(e,t){this._align(e),t||this._moveNode()},_moveNode:function(e){var t=[],n=[],r=this.nodeXY,i=this.actXY;t[0]=i[0]-this.lastXY[0],t[1]=i[1]-this.lastXY[1],n[0]=i[0]-this.nodeXY[0],n[1]=i[1]-this.nodeXY[1],this.region={0:i[0],1:i[1],area:0,top:i[1],right:i[0]+this.get(s).get(u),bottom:i[1]+this.get(s).get(o),left:i[0]},this.fire(m,{pageX:i[0],pageY:i[1],scroll:e,info:{start:r,xy:i,delta:t,offset:n}}),this.lastXY=i},_defDragFn:function(t){if(this.get("move")){if(t.scroll&&t.scroll.node){var n=t.scroll.node.getDOMNode();n===e.config.win?n.scrollTo(t.scroll.left,t.scroll.top):(t.scroll.node.set("scrollTop",t.scroll.top),t.scroll.node.set("scrollLeft",t.scroll.left))}this.get(s).setXY([t.pageX,t.pageY]),this.realXY=[t.pageX,t.pageY]}},_move:function(e){if(this.get("lock"))return!1;this.mouseXY=[e.pageX,e.pageY];if(!this._dragThreshMet){var t=Math.abs(this.startXY[0]-e.pageX),n=Math.abs(this.startXY[1]-e.pageY);if(t>this.get("clickPixelThresh")||n>this.get("clickPixelThresh"))this._dragThreshMet=!0,this.start(),e&&e.preventDefault&&e.preventDefault(),this._alignNode([e.pageX,e.pageY])}else this._clickTimeout&&this._clickTimeout.cancel(),this._alignNode([e.pageX,e.pageY])},stopDrag:function(){return this.get(i)&&n._end(),this},destructor:function(){this._unprep(),this.target&&this.target.destroy(),n._unregDrag(this)}}),e.namespace("DD"),e.DD.Drag=y},"3.9.0",{requires:["dd-ddm-base"]});
