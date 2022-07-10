! function (t) {
	t.extend(t.fn, {
		validate: function (e) {
			if (this.length) {
				var i = t.data(this[0], "validator");
				return i || (this.attr("novalidate", "novalidate"), i = new t.validator(e, this[0]), t.data(this[0], "validator", i), i.settings.onsubmit && (this.validateDelegate(":submit", "click", function (e) {
					i.settings.submitHandler && (i.submitButton = e.target), t(e.target).hasClass("cancel") && (i.cancelSubmit = !0), void 0 !== t(e.target).attr("formnovalidate") && (i.cancelSubmit = !0)
				}), this.submit(function (e) {
					function s() {
						var s;
						return !i.settings.submitHandler || (i.submitButton && (s = t("<input type='hidden'/>").attr("name", i.submitButton.name).val(t(i.submitButton).val()).appendTo(i.currentForm)), i.settings.submitHandler.call(i, i.currentForm, e), i.submitButton && s.remove(), !1)
					}
					return i.settings.debug && e.preventDefault(), i.cancelSubmit ? (i.cancelSubmit = !1, s()) : i.form() ? i.pendingRequest ? (i.formSubmitted = !0, !1) : s() : (i.focusInvalid(), !1)
				})), i)
			}
			e && e.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing.")
		},
		valid: function () {
			var e, i;
			return t(this[0]).is("form") ? e = this.validate().form() : (e = !0, i = t(this[0].form).validate(), this.each(function () {
				e = i.element(this) && e
			})), e
		},
		removeAttrs: function (e) {
			var i = {},
				s = this;
			return t.each(e.split(/\s/), function (t, e) {
				i[e] = s.attr(e), s.removeAttr(e)
			}), i
		},
		rules: function (e, i) {
			var s, r, n, a, o, u, l = this[0];
			if (e) switch (s = t.data(l.form, "validator").settings, r = s.rules, n = t.validator.staticRules(l), e) {
			case "add":
				t.extend(n, t.validator.normalizeRule(i)), delete n.messages, r[l.name] = n, i.messages && (s.messages[l.name] = t.extend(s.messages[l.name], i.messages));
				break;
			case "remove":
				return i ? (u = {}, t.each(i.split(/\s/), function (e, i) {
					u[i] = n[i], delete n[i], "required" === i && t(l).removeAttr("aria-required")
				}), u) : (delete r[l.name], n)
			}
			return (a = t.validator.normalizeRules(t.extend({}, t.validator.classRules(l), t.validator.attributeRules(l), t.validator.dataRules(l), t.validator.staticRules(l)), l)).required && (o = a.required, delete a.required, a = t.extend({
				required: o
			}, a), t(l).attr("aria-required", "true")), a.remote && (o = a.remote, delete a.remote, a = t.extend(a, {
				remote: o
			})), a
		}
	}), t.extend(t.expr[":"], {
		blank: function (e) {
			return !t.trim("" + t(e).val())
		},
		filled: function (e) {
			return !!t.trim("" + t(e).val())
		},
		unchecked: function (e) {
			return !t(e).prop("checked")
		}
	}), t.validator = function (e, i) {
		this.settings = t.extend(!0, {}, t.validator.defaults, e), this.currentForm = i, this.init()
	}, t.validator.format = function (e, i) {
		return 1 === arguments.length ? function () {
			var i = t.makeArray(arguments);
			return i.unshift(e), t.validator.format.apply(this, i)
		} : (arguments.length > 2 && i.constructor !== Array && (i = t.makeArray(arguments).slice(1)), i.constructor !== Array && (i = [i]), t.each(i, function (t, i) {
			e = e.replace(new RegExp("\\{" + t + "\\}", "g"), function () {
				return i
			})
		}), e)
	}, t.extend(t.validator, {
		defaults: {
			messages: {},
			groups: {},
			rules: {},
			errorClass: "error",
			validClass: "valid",
			errorElement: "label",
			focusInvalid: !0,
			errorContainer: t([]),
			errorLabelContainer: t([]),
			onsubmit: !0,
			ignore: ":hidden",
			ignoreTitle: !1,
			onfocusin: function (t) {
				this.lastActive = t, this.settings.focusCleanup && !this.blockFocusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, t, this.settings.errorClass, this.settings.validClass), this.addWrapper(this.errorsFor(t)).hide())
			},
			onfocusout: function (t) {
				this.checkable(t) || !(t.name in this.submitted) && this.optional(t) || this.element(t)
			},
			onkeyup: function (t, e) {
				9 === e.which && "" === this.elementValue(t) || (t.name in this.submitted || t === this.lastElement) && this.element(t)
			},
			onclick: function (t) {
				t.name in this.submitted ? this.element(t) : t.parentNode.name in this.submitted && this.element(t.parentNode)
			},
			highlight: function (e, i, s) {
				"radio" === e.type ? this.findByName(e.name).addClass(i).removeClass(s) : t(e).addClass(i).removeClass(s)
			},
			unhighlight: function (e, i, s) {
				"radio" === e.type ? this.findByName(e.name).removeClass(i).addClass(s) : t(e).removeClass(i).addClass(s)
			}
		},
		setDefaults: function (e) {
			t.extend(t.validator.defaults, e)
		},
		messages: {
			required: "This field is required.",
			remote: "Please fix this field.",
			email: "Please enter a valid email address.",
			url: "Please enter a valid URL.",
			date: "Please enter a valid date.",
			dateISO: "Please enter a valid date (ISO).",
			number: "Please enter a valid number.",
			digits: "Please enter only digits.",
			creditcard: "Please enter a valid credit card number.",
			equalTo: "Please enter the same value again.",
			maxlength: t.validator.format("Please enter no more than {0} characters."),
			minlength: t.validator.format("Please enter at least {0} characters."),
			rangelength: t.validator.format("Please enter a value between {0} and {1} characters long."),
			range: t.validator.format("Please enter a value between {0} and {1}."),
			max: t.validator.format("Please enter a value less than or equal to {0}."),
			min: t.validator.format("Please enter a value greater than or equal to {0}.")
		},
		autoCreateRanges: !1,
		prototype: {
			init: function () {
				function e(e) {
					var i = t.data(this[0].form, "validator"),
						s = "on" + e.type.replace(/^validate/, ""),
						r = i.settings;
					r[s] && !this.is(r.ignore) && r[s].call(i, this[0], e)
				}
				this.labelContainer = t(this.settings.errorLabelContainer), this.errorContext = this.labelContainer.length && this.labelContainer || t(this.currentForm), this.containers = t(this.settings.errorContainer).add(this.settings.errorLabelContainer), this.submitted = {}, this.valueCache = {}, this.pendingRequest = 0, this.pending = {}, this.invalid = {}, this.reset();
				var i, s = this.groups = {};
				t.each(this.settings.groups, function (e, i) {
					"string" == typeof i && (i = i.split(/\s/)), t.each(i, function (t, i) {
						s[i] = e
					})
				}), i = this.settings.rules, t.each(i, function (e, s) {
					i[e] = t.validator.normalizeRule(s)
				}), t(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'] ", "focusin focusout keyup", e).validateDelegate("[type='radio'], [type='checkbox'], select, option", "click", e), this.settings.invalidHandler && t(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler), t(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required", "true")
			},
			form: function () {
				return this.checkForm(), t.extend(this.submitted, this.errorMap), this.invalid = t.extend({}, this.errorMap), this.valid() || t(this.currentForm).triggerHandler("invalid-form", [this]), this.showErrors(), this.valid()
			},
			checkForm: function () {
				this.prepareForm();
				for (var t = 0, e = this.currentElements = this.elements(); e[t]; t++) this.check(e[t]);
				return this.valid()
			},
			element: function (e) {
				var i = this.clean(e),
					s = this.validationTargetFor(i),
					r = !0;
				return this.lastElement = s, void 0 === s ? delete this.invalid[i.name] : (this.prepareElement(s), this.currentElements = t(s), (r = !1 !== this.check(s)) ? delete this.invalid[s.name] : this.invalid[s.name] = !0), t(e).attr("aria-invalid", !r), this.numberOfInvalids() || (this.toHide = this.toHide.add(this.containers)), this.showErrors(), r
			},
			showErrors: function (e) {
				if (e) {
					t.extend(this.errorMap, e), this.errorList = [];
					for (var i in e) this.errorList.push({
						message: e[i],
						element: this.findByName(i)[0]
					});
					this.successList = t.grep(this.successList, function (t) {
						return !(t.name in e)
					})
				}
				this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
			},
			resetForm: function () {
				t.fn.resetForm && t(this.currentForm).resetForm(), this.submitted = {}, this.lastElement = null, this.prepareForm(), this.hideErrors(), this.elements().removeClass(this.settings.errorClass).removeData("previousValue").removeAttr("aria-invalid")
			},
			numberOfInvalids: function () {
				return this.objectLength(this.invalid)
			},
			objectLength: function (t) {
				var e, i = 0;
				for (e in t) i++;
				return i
			},
			hideErrors: function () {
				this.addWrapper(this.toHide).hide()
			},
			valid: function () {
				return 0 === this.size()
			},
			size: function () {
				return this.errorList.length
			},
			focusInvalid: function () {
				if (this.settings.focusInvalid) try {
					t(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
				} catch (t) {}
			},
			findLastActive: function () {
				var e = this.lastActive;
				return e && 1 === t.grep(this.errorList, function (t) {
					return t.element.name === e.name
				}).length && e
			},
			elements: function () {
				var e = this,
					i = {};
				return t(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function () {
					return !this.name && e.settings.debug && window.console && console.error("%o has no name assigned", this), !(this.name in i || !e.objectLength(t(this).rules())) && (i[this.name] = !0, !0)
				})
			},
			clean: function (e) {
				return t(e)[0]
			},
			errors: function () {
				var e = this.settings.errorClass.split(" ").join(".");
				return t(this.settings.errorElement + "." + e, this.errorContext)
			},
			reset: function () {
				this.successList = [], this.errorList = [], this.errorMap = {}, this.toShow = t([]), this.toHide = t([]), this.currentElements = t([])
			},
			prepareForm: function () {
				this.reset(), this.toHide = this.errors().add(this.containers)
			},
			prepareElement: function (t) {
				this.reset(), this.toHide = this.errorsFor(t)
			},
			elementValue: function (e) {
				var i, s = t(e),
					r = s.attr("type");
				return "radio" === r || "checkbox" === r ? t("input[name='" + s.attr("name") + "']:checked").val() : "string" == typeof (i = s.val()) ? i.replace(/\r/g, "") : i
			},
			check: function (e) {
				e = this.validationTargetFor(this.clean(e));
				var i, s, r, n = t(e).rules(),
					a = t.map(n, function (t, e) {
						return e
					}).length,
					o = !1,
					u = this.elementValue(e);
				for (s in n) {
					r = {
						method: s,
						parameters: n[s]
					};
					try {
						if ("dependency-mismatch" === (i = t.validator.methods[s].call(this, u, e, r.parameters)) && 1 === a) {
							o = !0;
							continue
						}
						if (o = !1, "pending" === i) return void(this.toHide = this.toHide.not(this.errorsFor(e)));
						if (!i) return this.formatAndAdd(e, r), !1
					} catch (t) {
						throw this.settings.debug && window.console && console.log("Exception occurred when checking element " + e.id + ", check the '" + r.method + "' method.", t), t
					}
				}
				if (!o) return this.objectLength(n) && this.successList.push(e), !0
			},
			customDataMessage: function (e, i) {
				return t(e).data("msg" + i[0].toUpperCase() + i.substring(1).toLowerCase()) || t(e).data("msg")
			},
			customMessage: function (t, e) {
				var i = this.settings.messages[t];
				return i && (i.constructor === String ? i : i[e])
			},
			findDefined: function () {
				for (var t = 0; t < arguments.length; t++)
					if (void 0 !== arguments[t]) return arguments[t]
			},
			defaultMessage: function (e, i) {
				return this.findDefined(this.customMessage(e.name, i), this.customDataMessage(e, i), !this.settings.ignoreTitle && e.title || void 0, t.validator.messages[i], "<strong>Warning: No message defined for " + e.name + "</strong>")
			},
			formatAndAdd: function (e, i) {
				var s = this.defaultMessage(e, i.method),
					r = /\$?\{(\d+)\}/g;
				"function" == typeof s ? s = s.call(this, i.parameters, e) : r.test(s) && (s = t.validator.format(s.replace(r, "{$1}"), i.parameters)), this.errorList.push({
					message: s,
					element: e,
					method: i.method
				}), this.errorMap[e.name] = s, this.submitted[e.name] = s
			},
			addWrapper: function (t) {
				return this.settings.wrapper && (t = t.add(t.parent(this.settings.wrapper))), t
			},
			defaultShowErrors: function () {
				var t, e, i;
				for (t = 0; this.errorList[t]; t++) i = this.errorList[t], this.settings.highlight && this.settings.highlight.call(this, i.element, this.settings.errorClass, this.settings.validClass), this.showLabel(i.element, i.message);
				if (this.errorList.length && (this.toShow = this.toShow.add(this.containers)), this.settings.success)
					for (t = 0; this.successList[t]; t++) this.showLabel(this.successList[t]);
				if (this.settings.unhighlight)
					for (t = 0, e = this.validElements(); e[t]; t++) this.settings.unhighlight.call(this, e[t], this.settings.errorClass, this.settings.validClass);
				this.toHide = this.toHide.not(this.toShow), this.hideErrors(), this.addWrapper(this.toShow).show()
			},
			validElements: function () {
				return this.currentElements.not(this.invalidElements())
			},
			invalidElements: function () {
				return t(this.errorList).map(function () {
					return this.element
				})
			},
			showLabel: function (e, i) {
				var s = this.errorsFor(e);
				s.length ? (s.removeClass(this.settings.validClass).addClass(this.settings.errorClass), s.html(i)) : (s = t("<" + this.settings.errorElement + ">").attr("for", this.idOrName(e)).addClass(this.settings.errorClass).html(i || ""), this.settings.wrapper && (s = s.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.append(s).length || (this.settings.errorPlacement ? this.settings.errorPlacement(s, t(e)) : s.insertAfter(e))), !i && this.settings.success && (s.text(""), "string" == typeof this.settings.success ? s.addClass(this.settings.success) : this.settings.success(s, e)), this.toShow = this.toShow.add(s)
			},
			errorsFor: function (e) {
				var i = this.idOrName(e);
				return this.errors().filter(function () {
					return t(this).attr("for") === i
				})
			},
			idOrName: function (t) {
				return this.groups[t.name] || (this.checkable(t) ? t.name : t.id || t.name)
			},
			validationTargetFor: function (t) {
				return this.checkable(t) && (t = this.findByName(t.name).not(this.settings.ignore)[0]), t
			},
			checkable: function (t) {
				return /radio|checkbox/i.test(t.type)
			},
			findByName: function (e) {
				return t(this.currentForm).find("[name='" + e + "']")
			},
			getLength: function (e, i) {
				switch (i.nodeName.toLowerCase()) {
				case "select":
					return t("option:selected", i).length;
				case "input":
					if (this.checkable(i)) return this.findByName(i.name).filter(":checked").length
				}
				return e.length
			},
			depend: function (t, e) {
				return !this.dependTypes[typeof t] || this.dependTypes[typeof t](t, e)
			},
			dependTypes: {
				boolean: function (t) {
					return t
				},
				string: function (e, i) {
					return !!t(e, i.form).length
				},
				function: function (t, e) {
					return t(e)
				}
			},
			optional: function (e) {
				var i = this.elementValue(e);
				return !t.validator.methods.required.call(this, i, e) && "dependency-mismatch"
			},
			startRequest: function (t) {
				this.pending[t.name] || (this.pendingRequest++, this.pending[t.name] = !0)
			},
			stopRequest: function (e, i) {
				this.pendingRequest--, this.pendingRequest < 0 && (this.pendingRequest = 0), delete this.pending[e.name], i && 0 === this.pendingRequest && this.formSubmitted && this.form() ? (t(this.currentForm).submit(), this.formSubmitted = !1) : !i && 0 === this.pendingRequest && this.formSubmitted && (t(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
			},
			previousValue: function (e) {
				return t.data(e, "previousValue") || t.data(e, "previousValue", {
					old: null,
					valid: !0,
					message: this.defaultMessage(e, "remote")
				})
			}
		},
		classRuleSettings: {
			required: {
				required: !0
			},
			email: {
				email: !0
			},
			url: {
				url: !0
			},
			date: {
				date: !0
			},
			dateISO: {
				dateISO: !0
			},
			number: {
				number: !0
			},
			digits: {
				digits: !0
			},
			creditcard: {
				creditcard: !0
			}
		},
		addClassRules: function (e, i) {
			e.constructor === String ? this.classRuleSettings[e] = i : t.extend(this.classRuleSettings, e)
		},
		classRules: function (e) {
			var i = {},
				s = t(e).attr("class");
			return s && t.each(s.split(" "), function () {
				this in t.validator.classRuleSettings && t.extend(i, t.validator.classRuleSettings[this])
			}), i
		},
		attributeRules: function (e) {
			var i, s, r = {},
				n = t(e),
				a = e.getAttribute("type");
			for (i in t.validator.methods) "required" === i ? ("" === (s = e.getAttribute(i)) && (s = !0), s = !!s) : s = n.attr(i), /min|max/.test(i) && (null === a || /number|range|text/.test(a)) && (s = Number(s)), s || 0 === s ? r[i] = s : a === i && "range" !== a && (r[i] = !0);
			return r.maxlength && /-1|2147483647|524288/.test(r.maxlength) && delete r.maxlength, r
		},
		dataRules: function (e) {
			var i, s, r = {},
				n = t(e);
			for (i in t.validator.methods) void 0 !== (s = n.data("rule" + i[0].toUpperCase() + i.substring(1).toLowerCase())) && (r[i] = s);
			return r
		},
		staticRules: function (e) {
			var i = {},
				s = t.data(e.form, "validator");
			return s.settings.rules && (i = t.validator.normalizeRule(s.settings.rules[e.name]) || {}), i
		},
		normalizeRules: function (e, i) {
			return t.each(e, function (s, r) {
				if (!1 !== r) {
					if (r.param || r.depends) {
						var n = !0;
						switch (typeof r.depends) {
						case "string":
							n = !!t(r.depends, i.form).length;
							break;
						case "function":
							n = r.depends.call(i, i)
						}
						n ? e[s] = void 0 === r.param || r.param : delete e[s]
					}
				} else delete e[s]
			}), t.each(e, function (s, r) {
				e[s] = t.isFunction(r) ? r(i) : r
			}), t.each(["minlength", "maxlength"], function () {
				e[this] && (e[this] = Number(e[this]))
			}), t.each(["rangelength", "range"], function () {
				var i;
				e[this] && (t.isArray(e[this]) ? e[this] = [Number(e[this][0]), Number(e[this][1])] : "string" == typeof e[this] && (i = e[this].split(/[\s,]+/), e[this] = [Number(i[0]), Number(i[1])]))
			}), t.validator.autoCreateRanges && (e.min && e.max && (e.range = [e.min, e.max], delete e.min, delete e.max), e.minlength && e.maxlength && (e.rangelength = [e.minlength, e.maxlength], delete e.minlength, delete e.maxlength)), e
		},
		normalizeRule: function (e) {
			if ("string" == typeof e) {
				var i = {};
				t.each(e.split(/\s/), function () {
					i[this] = !0
				}), e = i
			}
			return e
		},
		addMethod: function (e, i, s) {
			t.validator.methods[e] = i, t.validator.messages[e] = void 0 !== s ? s : t.validator.messages[e], i.length < 3 && t.validator.addClassRules(e, t.validator.normalizeRule(e))
		},
		methods: {
			required: function (e, i, s) {
				if (!this.depend(s, i)) return "dependency-mismatch";
				if ("select" === i.nodeName.toLowerCase()) {
					var r = t(i).val();
					return r && r.length > 0
				}
				return this.checkable(i) ? this.getLength(e, i) > 0 : t.trim(e).length > 0
			},
			email: function (t, e) {
				return this.optional(e) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(t)
			},
			url: function (t, e) {
				return this.optional(e) || /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(t)
			},
			date: function (t, e) {
				return this.optional(e) || !/Invalid|NaN/.test(new Date(t).toString())
			},
			dateISO: function (t, e) {
				return this.optional(e) || /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/.test(t)
			},
			number: function (t, e) {
				return this.optional(e) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(t)
			},
			digits: function (t, e) {
				return this.optional(e) || /^\d+$/.test(t)
			},
			creditcard: function (t, e) {
				if (this.optional(e)) return "dependency-mismatch";
				if (/[^0-9 \-]+/.test(t)) return !1;
				var i, s, r = 0,
					n = 0,
					a = !1;
				if ((t = t.replace(/\D/g, "")).length < 13 || t.length > 19) return !1;
				for (i = t.length - 1; i >= 0; i--) s = t.charAt(i), n = parseInt(s, 10), a && (n *= 2) > 9 && (n -= 9), r += n, a = !a;
				return r % 10 == 0
			},
			minlength: function (e, i, s) {
				var r = t.isArray(e) ? e.length : this.getLength(t.trim(e), i);
				return this.optional(i) || r >= s
			},
			maxlength: function (e, i, s) {
				var r = t.isArray(e) ? e.length : this.getLength(t.trim(e), i);
				return this.optional(i) || r <= s
			},
			rangelength: function (e, i, s) {
				var r = t.isArray(e) ? e.length : this.getLength(t.trim(e), i);
				return this.optional(i) || r >= s[0] && r <= s[1]
			},
			min: function (t, e, i) {
				return this.optional(e) || t >= i
			},
			max: function (t, e, i) {
				return this.optional(e) || t <= i
			},
			range: function (t, e, i) {
				return this.optional(e) || t >= i[0] && t <= i[1]
			},
			equalTo: function (e, i, s) {
				var r = t(s);
				return this.settings.onfocusout && r.unbind(".validate-equalTo").bind("blur.validate-equalTo", function () {
					t(i).valid()
				}), e === r.val()
			},
			remote: function (e, i, s) {
				if (this.optional(i)) return "dependency-mismatch";
				var r, n, a = this.previousValue(i);
				return this.settings.messages[i.name] || (this.settings.messages[i.name] = {}), a.originalMessage = this.settings.messages[i.name].remote, this.settings.messages[i.name].remote = a.message, s = "string" == typeof s && {
					url: s
				} || s, a.old === e ? a.valid : (a.old = e, r = this, this.startRequest(i), n = {}, n[i.name] = e, t.ajax(t.extend(!0, {
					url: s,
					mode: "abort",
					port: "validate" + i.name,
					dataType: "json",
					data: n,
					context: r.currentForm,
					success: function (s) {
						var n, o, u, l = !0 === s || "true" === s;
						r.settings.messages[i.name].remote = a.originalMessage, l ? (u = r.formSubmitted, r.prepareElement(i), r.formSubmitted = u, r.successList.push(i), delete r.invalid[i.name], r.showErrors()) : (n = {}, o = s || r.defaultMessage(i, "remote"), n[i.name] = a.message = t.isFunction(o) ? o(e) : o, r.invalid[i.name] = !0, r.showErrors(n)), a.valid = l, r.stopRequest(i, l)
					}
				}, s)), "pending")
			}
		}
	}), t.format = function () {
		throw "$.format has been deprecated. Please use $.validator.format instead."
	}
}(jQuery),
function (t) {
	var e, i = {};
	t.ajaxPrefilter ? t.ajaxPrefilter(function (t, e, s) {
		var r = t.port;
		"abort" === t.mode && (i[r] && i[r].abort(), i[r] = s)
	}) : (e = t.ajax, t.ajax = function (s) {
		var r = ("mode" in s ? s : t.ajaxSettings).mode,
			n = ("port" in s ? s : t.ajaxSettings).port;
		return "abort" === r ? (i[n] && i[n].abort(), i[n] = e.apply(this, arguments), i[n]) : e.apply(this, arguments)
	})
}(jQuery),
function (t) {
	t.extend(t.fn, {
		validateDelegate: function (e, i, s) {
			return this.bind(i, function (i) {
				var r = t(i.target);
				if (r.is(e)) return s.apply(r, arguments)
			})
		}
	})
}(jQuery);