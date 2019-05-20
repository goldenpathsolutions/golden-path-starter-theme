# Layout Conventions

These layout templates are designed to work with ACF fields.  In order to work properly with the layout factory, a number of naming conventions must be followed.

## File Naming Conventions

1. Each layout definition must be in a separate file.
1. Each layout definition file must be stored in one of the following subdirectories, depending on the type:
    1. **sections** — these are rows that span the width of the viewport.
    1. **blocks** — these are containers for content.
    1. **components** — these are individual, reusable content fields that comprise blocks.
1. Each layout definition must be a class whose file name is lower case, and of the form `class-[layout type]-[layout slug].php`
    1. Example: `class-section-flexible-content.php`
1. Each class file must be namespaced according to its layout type: `namespace GPS\Layouts\[Layout Type];`
    1. Example: `namespace GPS\Layouts\Sections;`
1. Each class name must go as follows (note the underscores between words and capitalization): `class [Layout type]_[Layout slug]`
    1. Example: `class Section_Flexible_Content`
    
## ACF Conventions

### Attributes
Attributes can be added to any type of layout.  For example, all layouts should have an advanced attribute of class.
1. Attributes should be added to the Attributes field group.
1. Attribute names should simply match their labels with underscores between words.  They should not include "attribute".

### Content Block Components (Components)
1. Content Block Components (layout type: Component) should be added to the Content Block Components field group.
1. They should be of type group, and should minimally include Content, Attributes, and Advanced tabs.
1. Their names should start with "component" and then the name of the component.
1. Use underscores to separate words.
1. The ACF name should match the corresponding class, except it should be entirely in lower case.

### Content Blocks (Blocks)
1. Content Blocks (layout type: Block) should be added to the Content Block field group.
1. They should be group type fields.
1. They should minimally include content, attribute, and advanced tabs.
1. Their ACF names should start with "block" and then the name of the block.
1. The ACF name should match the corresponding class, except it should be entirely in lower case.

#### Flexible Content Block
1. The content part of the Flexible Content Block should include a flexible content field with a called content_components.
1. Each Content Block Component used in the flexible field should be given its own layout.
1. Name the layouts with the same name as the component, but use hyphens instead of underscores.  Really this isn't necessary, it just helps differentiate the layout from the field name.
1. Add a clone field for the Component, and give it the same name as the component.

### Sections
Sections follow similar conventions as Content Blocks.
1. In ACF, Sections should be stored individually in the Sections custom field group.
1. They should be group type fields.
1. They should minimally include content, attribute, and advanced tabs.
1. Their ACF names should start with "section" and then the name of the section.
1. The ACF name should match the corresponding class, except it should be entirely in lower case.

#### Flexible Content Section
1. The content part of the Flexible Content Section should include a flexible content field called content_blocks.
1. Each Content Block used in the flexible field should be given its own layout.
1. Name the layouts with the same name as the block, but use hyphens instead of underscores.  Really this isn't necessary, it just helps differentiate the layout from the field name.
1. Add a clone field for the Block, and give it the same name as the Block.

### Page Sections
The Page Sections field group is an exaple of actually implementing Content Sections.
1. Create a flexible content field.
1. Make a layout for each section.
1. The name of the layout should be the same as that of the section, but with hyphens instead of underscores.
1. Add a clone field for the Section, and give it the same name as the Section.
