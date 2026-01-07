#!/bin/bash
set -e

# Build script for Lizmap Docker image with kartoza naming
# Usage: ./build-docker.sh [--release]

REGISTRY_URL="kartoza"
DO_RELEASE=""

while [[ $# -gt 0 ]]; do
    case $1 in
        --release)
            DO_RELEASE="DO_RELEASE=1"
            shift
            ;;
        *)
            echo "Unknown option: $1"
            echo "Usage: $0 [--release]"
            exit 1
            ;;
    esac
done

# Extract version from project.xml
LIZMAP_VERSION_TAG=$(sed -n 's:.*<version[^>]*>\(.*\)</version>.*:\1:p' lizmap/project.xml)

if [ -z "$LIZMAP_VERSION_TAG" ]; then
    echo "Error: Could not extract version from lizmap/project.xml"
    exit 1
fi

echo "================================================"
echo "Building Lizmap Docker Image"
echo "================================================"
echo "Registry: $REGISTRY_URL"
echo "Version: $LIZMAP_VERSION_TAG"
if [ -n "$DO_RELEASE" ]; then
    echo "Release Mode: YES"
else
    echo "Release Mode: NO (will tag as ${LIZMAP_VERSION_TAG%.*}-dev)"
fi
echo "================================================"
echo ""

# Build dependencies and assets using Docker builder
echo "Step 1: Building package using Docker builder..."
echo "  - Creating builder container with PHP, composer, and npm..."
echo "  - Running composer update inside container..."
echo "  - Installing npm packages inside container..."
echo "  - Building JavaScript assets inside container..."
make -C dev package

# Build the Docker image
echo ""
echo "Step 2: Building Docker image..."
make docker-build REGISTRY_URL="$REGISTRY_URL" $DO_RELEASE

# Tag the image
echo ""
echo "Step 3: Tagging Docker image..."
make docker-tag REGISTRY_URL="$REGISTRY_URL" $DO_RELEASE

echo ""
echo "================================================"
echo "Build Complete!"
echo "================================================"
echo ""
echo "Built images:"
docker images | grep "$REGISTRY_URL/lizmap-web-client" | head -5

echo ""
echo "To push to registry, run:"
echo "  make docker-deliver REGISTRY_URL=$REGISTRY_URL $DO_RELEASE"
