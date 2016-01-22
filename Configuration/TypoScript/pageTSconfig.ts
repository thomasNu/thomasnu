RTE.default {
  proc.allowedClasses := addToList(note, mini, mark, markblue, red, border)
  proc.entryHTMLparser_db.removeTags = center, font, link, meta, o:p, sdfield, strike, style, title
  removeTags = center, font, o:p, sdfield, strike
  showButtons = blockstylelabel, blockstyle, textstylelabel, textstyle, bold, italic, underline, subscript, superscript, formatblock, orderedlist, unorderedlist, definitionlist, definitionitem, outdent, indent, insertcharacter, link, image, findreplace, chMode, removeformat, undo, redo, about
  buttons {
    formatblock.removeItems = h1, pre, address, blockquote
    textstyle.tags.span.allowedClasses = important, note, mini, mark, markblue, red, border
    blockstyle.tags.div >
    blockstyle.tags.table >
    blockstyle.tags.td >
    blockstyle.tags.all.allowedClasses = csc-frame-frame1, csc-frame-frame2, align-left, align-center, align-right, indent, note, mini, border
    blockstyle.showTagFreeClasses = 1
    textstyle.showTagFreeClasses = 1
    pastetoggle.setActiveOnRteOpen = 1
    pastetoggle.hidden = 1
    }
  contentCSS = EXT:thomasnu/Resources/Public/Stylesheet/design.css
  }
RTE.default.FE >
RTE.default.FE < RTE.default
RTE.classes {
  name-of-person >
  detail >
  }
RTE.classesAnchor {
  externalLink.titleText =
  externalLinkInNewWindow.titleText =
  externalLinkInNewWindow.target = _blank
  internalLink.titleText =
  internalLinkInNewWindow.titleText =
  download.titleText =
  download.target = _blank
  mail.titleText =
  }
