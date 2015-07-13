require 'liquid'
require 'uri'

# Capitalize all words of the input
module Unslugify
  def unslugify(words)
    return words.split('-').map(&:capitalize).join(' ')
  end
end

Liquid::Template.register_filter(Unslugify)